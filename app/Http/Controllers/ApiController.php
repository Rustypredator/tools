<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\Config;

class ApiController extends Controller
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
     * Shows information about the api or application
     *
     * @return void
     */
    public function info()
    {
        return response()->json(['api' => Config::get('app.name'), 'version' => Config::get('app.version')]);
    }
}
