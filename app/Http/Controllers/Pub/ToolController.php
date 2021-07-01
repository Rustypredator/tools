<?php

namespace App\Http\Controllers\Pub;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ToolController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($tool)
    {
        switch ($tool) {
            case 'pwgen':
                $data = [
                    'pwgen_uc' => true,
                    'pwgen_lc' => false,
                    'pwgen_nr' => false,
                    'pwgen_sc' => false,
                    'pwgen_length' => 8,
                    'pwgen_amount' => 1
                ];
                return view('themes.default.pub.tool.pwgen', $data);
                //$this->pwgen($request);
                break;

            default:
                return view('themes.default.errors.404');
                break;
        }
    }
}
