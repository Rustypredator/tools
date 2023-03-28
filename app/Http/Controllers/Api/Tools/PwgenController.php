<?php

namespace App\Http\Controllers\Api\Tools;

use App\Helpers\Pwgen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Api\ToolsController;

class PwgenController extends ToolsController
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
    public function index(Request $request, $action = null)
    {
        if (is_null($action) || empty($action) || $action == '') {
            return response()->json(['tool' => 'Password Generator', 'short' => 'pwgen', 'description' => 'it\'s a Password Generator.', 'version' => '0.0.1']);
        } else {
            switch ($action) {
                case 'generatePasswords':
                    //get Inputs:
                    $uc = ($request->input('uc') === 'true') ? true:false;
                    $lc = ($request->input('lc') === 'true') ? true:false;
                    $nr = ($request->input('nr') === 'true') ? true:false;
                    $sc = ($request->input('sc') === 'true') ? true:false;
                    $length = (int)$request->input('length');
                    $amount = (int)$request->input('amount');
                    $passwords = Pwgen::generate($uc, $lc, $sc, $nr, $length, $amount);
                    Cookie::queue('pwgen_uc', ($uc) ? 'on':'off', 10080);
                    Cookie::queue('pwgen_lc', ($lc) ? 'on':'off', 10080);
                    Cookie::queue('pwgen_sc', ($sc) ? 'on':'off', 10080);
                    Cookie::queue('pwgen_nr', ($nr) ? 'on':'off', 10080);
                    //$response = new Response();
                    return response()->json(['generatedPasswords' => $passwords]);
                    //echo json_encode(['generatedPasswords' => $passwords]);
                    //return $response;
                    break;
                default:
                    echo json_encode([]);
                    break;
            }
        }
    }
}
