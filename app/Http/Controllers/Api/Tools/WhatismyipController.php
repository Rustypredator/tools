<?php

namespace App\Http\Controllers\Api\Tools;

use App\Http\Controllers\Api\ToolsController;
use Illuminate\Http\Request;

class WhatismyipController extends ToolsController
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
        if(is_null($action) || empty($action) || $action == '') {
            return response()->json(['tool' => 'What is my IP?', 'short' => 'whatismyip', 'description' => 'Displays your IP', 'version' => '0.0.1']);
        } else {
            switch ($action) {
                case 'raw':
                    $ip = $request->ip();
                    if ($request->hasHeader('HTTP_X_REAL_IP') && !empty($request->header('HTTP_X_REAL_IP'))) {
                        $ip = $request->header('HTTP_X_REAL_IP');
                    } elseif ($request->hasHeader('HTTP_X_FORWARDED_FOR')  && !empty($request->header('HTTP_X_FORWARDED_FOR'))) {
                        $ip = $request->header('HTTP_X_FORWARDED_FOR');
                    } else {
                        $ip = $request->header('REMOTE_ADDR');
                    }
                    return response()->json(['ip' => $ip]);
                    break;
                default:
                    break;
            }
        }

    }
}
