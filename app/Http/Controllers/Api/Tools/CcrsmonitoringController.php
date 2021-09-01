<?php

namespace App\Http\Controllers\Api\Tools;

use App\Http\Controllers\Api\ToolsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            default:
                request()->json(["unknown action"]);
                break;
        }
    }

    private function ingest(Request $request) {
        //Ingest data from endpoint
        //$data = $request->getContent(); //or $request->all();
        $data = $request->input('data');
        //content // Items - arr, tasks -obj, fluids -obj, patterns -arr, energyUsage int, energyStorage int, storages obj
        $key = $request->bearerToken();
        $system = DB::table('tools_ccrsmon_systems')->select('*')->where('key', $key)->first();
        if (!$system) {
            request()->json(["unknown system! please remember to set your token!"]);
            return false;
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
}
