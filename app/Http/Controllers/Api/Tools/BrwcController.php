<?php

namespace App\Http\Controllers\Api\Tools;

use App\Http\Controllers\Api\ToolsController;

class BrwcController extends ToolsController
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
    public function index($action = "", $params = [])
    {
        return response()->json(['tool' => 'Big(ger) Reactors Controlpanel', 'short' => 'brwc', 'description' => 'Controlpanel for the popular BigReactors Minecraft Mod. Only works together with Computercraft to send data.', 'version' => '0.0.1']);
    }
}
