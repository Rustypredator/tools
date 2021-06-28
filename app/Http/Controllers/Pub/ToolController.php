<?php

namespace App\Http\Controllers\Pub;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class ToolController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, $tool, $toolSubsite = '')
    {
        switch ($tool) {
            case 'pwgen':
                $this->pwgen($request);
                break;

            default:
                return view('themes.default.errors.404');
                break;
        }
    }

    public function ajaxIndex(Request $request, $tool) {
        switch ($tool) {
            case 'pwgen':
                $passwords = $this->generateRandomString($request->input('pwgen_uc'), $request->input('pwgen_lc'), $request->input('pwgen_sc'), $request->input('pwgen_nr'), $request->input('pwgen_length'), $request->input('pwgen_amount'));
                echo json_encode($passwords);
                break;

            default:
                echo json_encode([]);
                break;
        }
    }

    private function pwgen(Request $request) {
        $data = [
            'pwgen_uc' => true,
            'pwgen_lc' => false,
            'pwgen_nr' => false,
            'pwgen_sc' => false,
            'pwgen_length' => 8,
            'pwgen_amount' => 1
        ];
        if($request->has('uc') && $request->input('uc')) {
            $data['pwgen_uc'] = true;
        }
        if($request->has('lc') && $request->input('lc')) {
            $data['pwgen_lc'] = true;
        }
        if($request->has('nr') && $request->input('nr')) {
            $data['pwgen_nr'] = true;
        }
        if($request->has('sc') && $request->input('sc')) {
            $data['pwgen_sc'] = true;
        }
        if($request->has('length') && $request->input('length') >= 0) {
            $data['pwgen_length'] = $request->input('length');
        }
        if($request->has('amount') && $request->input('amount' >= 0)) {
            $data['pwgen_amount'] = $request->input('amount');
        }

        return view('themes.default.pub.tool.pwgen', $data);
    }

    /**
     * Generates a Random string by the given options
     * @param  boolean $uppercase    enables uppercase chars
     * @param  boolean $lowercase    enables lowercase chars
     * @param  boolean $specialchars enables special chars
     * @param  int $length           commands the length of the string
     * @return array                 the generated string(s)
     */
    private function generateRandomString($uppercase, $lowercase, $specialchars, $numbers, $length, $batchsize)
    {
        $strings = array();
        for ($i = 0; $i<$batchsize; $i++) {
            //Make random string each time
            $usedChars = "";
            if ($uppercase) {
                $usedChars .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            }
            if ($lowercase) {
                $usedChars .= 'abcdefghijklmnopqrstuvwxyz';
            }
            if ($specialchars) {
                $usedChars .='!?@(){}[]\/=~$%&#*-+.,_';
            }
            if ($numbers) {
                $usedChars .= '0123456789';
            }

            $string = "";
            for ($b = 0; $b < $length; $b++) {
                $string .= $usedChars[rand(0, strlen($usedChars) - 1)];
            }
            $strings[] = $string;
        }
        return $strings;
    }
}