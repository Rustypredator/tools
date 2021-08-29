<?php

namespace App\Http\Controllers\Api\Tools;

use App\Http\Controllers\Api\ToolsController;
use Illuminate\Http\Request;

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
        $data = $request->input('rs_data');
    }
}
