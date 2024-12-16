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
                    $ip = $request->ip();
                    if (isset($_SERVER['HTTP_X_REAL_IP']) && !empty($_SERVER['HTTP_X_REAL_IP'])) {
                        $ip = $_SERVER['HTTP_X_REAL_IP'];
                    } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                    } else {
                        $ip = $_SERVER['REMOTE_ADDR'];
                    }
                    return response()->json(['ip' => $ip]);
                    break;
                default:
                    break;
            }
        }

    }
}
