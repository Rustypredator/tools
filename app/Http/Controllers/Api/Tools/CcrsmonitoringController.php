<?php

namespace App\Http\Controllers\Api\Tools;

use App\Http\Controllers\Api\ToolsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use InfluxDB2\Client;
use InfluxDB2\Model\WritePrecision;
use InfluxDB2\WriteType;

class CcrsmonitoringController extends ToolsController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //Public api, no authentication.
    }

    /**
     * Index
     *
     * @return void
     */
    public function index(Request $request, $action = "", $params = [])
    {
        $res = [];
        switch ($action) {
            case 'ingest':
                $res = $this->ingest($request);
                break;
            case 'reglog':
                $res = $this->registerSystem($request);
                break;
            case 'data':
                $res = $this->data($request);
                break;
            default:
                $res = ['success' => false, 'message' => 'unknown action'];
                break;
        }
        return response()->json($res);
    }

    /**
     * Registers a new System.
     *
     * @param Request $request
     * @return void
     */
    private function registerSystem(Request $request)
    {
        $key = $request->input('key');
        //check if system already registered:
        $check = DB::table('tools_ccrsmon_systems')->select('*')->where('key', $key)->first();
        if ($check) {
            //already exists and key matches.
            //check owner
            if ($check->owner == Auth::id() || $check->owner == null) {
                return ['success' => true, 'message' => 'successfully logged in.'];
            }
            return ['success' => false, 'message' => 'Not authorized to access this system!'];
        }
        $insertData['key'] = $key;
        if (Auth::check()) {
            $insertData['owner'] = Auth::id();
        } else {
            $insertData['owner'] = null;
        }
        DB::table('tools_ccrsmon_systems')->insert($insertData);
        return ['success' => true, 'message' => 'successfully registered.'];
    }

    /**
     * Ingests Data from a system
     *
     * @param Request $request
     * @return void
     */
    private function ingest(Request $request)
    {
        //Ingest data from endpoint
        //$data = $request->getContent(); //or $request->all();
        $data = $request->getContent();
        $data = json_decode($data);
        //content // Items - arr, tasks -obj, fluids -obj, patterns -arr, energyUsage int, energyStorage int, storages obj
        $key = $request->bearerToken();
        $system = DB::table('tools_ccrsmon_systems')->select('*')->where('key', $key)->first();
        if (!$system) {
            return ["unknown system! please remember to set your token!"];
        }
        if ($key == $system->key) {
            //key matches
            if (!is_object($data)) {
                return ['success' => false, 'message' => 'unexpected data.', 'sent_data' => $data];
            }
            $items = $data->items;
            $tasks = $data->tasks;
            $fluids = $data->fluids;
            $patterns = $data->patterns;
            $storages = $data->storages;
            $processed = $data->proc;
            DB::table('tools_ccrsmon_data')->insert([
                "system" => $system->id,
                "processed" => json_encode($processed),
                "items" => json_encode($items),
                "tasks" => json_encode($tasks),
                "fluids" => json_encode($fluids),
                "patterns" => json_encode($patterns),
                "energyUsage" => json_encode($processed->energy->usage),
                "energyStorage" => json_encode($processed->energy->stored),
                "storages" => json_encode($storages),
                "source" => $request->ip()
            ]);
            //write to influxdb?
            $token = '3gMtFZqh8eXSA_oTOi6pWpMSGR_FHD5aQR-LNVCD8uTp0MbeY8L8PC_wDb-aBjU4_31J_HubMiwHEzx_vEoEog==';
            $org = 'SKMPNT';
            $bucket = 'htav_mc_ccrsm';

            $client = new Client([
                "url" => "https://web.steltenkamp.net:8086",
                "token" => $token,
                "verifySSL" => false,
                "tags" => [
                    'system' => $system->id,
                    'src' => $request->ip(),
                    'version' => $request->header('user-agent', 'unknown'),
                ],
                "bucket" => $bucket,
                "org" => $org,
                "precision" => WritePrecision::S
            ]);
            $writeApi = $client->createWriteApi([
                "writeType" => WriteType::BATCHING,
                "batchSize" => 1000
            ]);

            //Items:
            foreach ($items as $item) {
                $dataArray = [
                    'name' => 'item_'.$item->name,
                    'fields' => [
                        'displayName' => $item->displayName,
                        'stored' => $item->count,
                    ],
                    'time' => microtime(true)
                ];
                $writeApi->write($dataArray);
            }
            //fluids:
            foreach ($fluids as $fluid) {
                $dataArray = [
                    'name' => 'fluid_'.$fluid->name,
                    'fields' => [
                        'displayName' => $fluid->displayName,
                        'stored' => $fluid->amount,
                    ],
                    'time' => microtime(true)
                ];
                $writeApi->write($dataArray);
            }
            //Tasks
            foreach ($tasks as $task) {
                $dataArray = [
                    'name' => 'task_'.$task->stack->item->name,
                    'fields' => [
                        'displayName' => $task->stack->item->displayName,
                        'quantity' => $task->quantity
                    ],
                    'time' => microtime(true)
                ];
                $writeApi->write($dataArray);
            }
            //Processed Data:
            foreach ($processed as $categoryName => $category) {
                foreach ($category as $itemName => $value) {
                    $dataArray = [
                        'name' => $categoryName.'_'.$itemName,
                        'fields' => [
                            'val' => $value
                        ],
                        'time' => microtime(true)
                    ];
                    $writeApi->write($dataArray);
                }
            }
            $writeApi->close();
        }
    }

    /**
     * Returns data
     *
     * @param Request $request
     * @return void
     */
    private function data(Request $request)
    {
        $key = $request->input('key');
        $system = DB::table('tools_ccrsmon_systems')->select('*')->where('key', $key)->first();
        if (!$system || $system->key !== $key) {
            return ["unknown system!"];
        } else {
            $data = DB::table('tools_ccrsmon_data')->select('*')->where('id', $system->id)->orderBy('addedAt', 'desc')->first();
            return $data;
        }
    }
}
