<?php

namespace App\Http\Controllers\Api\Tools;

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
    public function index($action = null, $params = null)
    {
        if(is_null($action)) {
            return response()->json(['tool' => 'Password Generator', 'short' => 'pwgen', 'description' => 'it\'s a Password Generator.', 'version' => '0.0.1']);
        } else {
            switch ($action) {
                case '':
                    # code...
                    break;

                default:
                    # code...
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
