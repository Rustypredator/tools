<?php

namespace App\Http\Controllers\Api\Tools;

use App\Http\Controllers\Api\ToolsController;
use Illuminate\Http\Request;

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
        if(is_null($action) || empty($action) || $action == '') {
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
                    $passwords = $this->generateRandomString($uc, $lc, $sc, $nr, $length, $amount);
                    echo json_encode(['generatedPasswords' => $passwords]);
                    break;
                default:
                    echo json_encode([]);
                    break;
            }
        }
    }

    /**
     * Generates a Random string by the given options
     * @param  boolean $uppercase    enables uppercase chars
     * @param  boolean $lowercase    enables lowercase chars
     * @param  boolean $specialchars enables special chars
     * @param  int $length           commands the length of the string
     * @return array                 the generated string(s)
     */
    private function generateRandomString($uppercase = false, $lowercase = false, $specialchars = false, $numbers = false, $length = 8, $batchsize = 1)
    {
        echo "UC: " . (string)$uppercase;
        echo "LC: " . (string)$lowercase;
        echo "SC: " . (string)$specialchars;
        echo "NR: " . (string)$numbers;
        if(!$uppercase && !$lowercase && !$specialchars && !$numbers) {
            return false;
        }

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
