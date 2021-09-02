<?php

namespace App\Http\Controllers\Api\Tools;

use App\Http\Controllers\Api\ToolsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
        switch ($action) {
            case 'ingest':
                $this->ingest($request);
                break;
            case 'reglog':
                $this->registerSystem($request);
                break;
            case 'data':
                $this->data($request);
                break;
            default:
                return response()->json(["unknown action"]);
                break;
        }
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
                return response()->json(['success' => true, 'message' => 'successfully logged in.']);
            }
        }
        $insertData['key'] = $key;
        if (Auth::check()) {
            $insertData['owner'] = Auth::id();
        } else {
            $insertData['owner'] = null;
        }
        DB::table('tools_ccrsmon_systems')->insert($insertData);
        return response()->json(['success' => true, 'message' => 'successfully registered.']);
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
        $data = $request->input('data');
        //content // Items - arr, tasks -obj, fluids -obj, patterns -arr, energyUsage int, energyStorage int, storages obj
        $key = $request->bearerToken();
        $system = DB::table('tools_ccrsmon_systems')->select('*')->where('key', $key)->first();
        if (!$system) {
            return response()->json(["unknown system! please remember to set your token!"]);
        }
        if ($key == $system->key) {
            //key matches, save data.
            if (!is_array($data) || count($data) < 7) {
                request()->json(["unexpected data."]);
                return false;
            }
            $items = $data[0];
            $tasks = $data[1];
            $fluids = $data[2];
            $patterns = $data[3];
            $energyUsage = $data[4];
            $energyStorage = $data[5];
            $storages = $data[6];
            DB::table('tools_ccrsmon_data')->insert(["items" => $items, "tasks" => $tasks, "fluids" => $fluids, "patterns" => $patterns, "energyUsage" => $energyUsage, "energyStorage" => $energyStorage, "storages" => $storages]);
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
            return response()->json(["unknown system!"]);
        } else {
            $data = DB::table('tools_ccrsmon_data')->select('*')->where('id', $system->id)->orderBy('addedAt', 'desc')->first();
            return response()->json($data);
        }
    }
}
