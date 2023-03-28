<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;

class Pwgen
{
    /**
     * Generates a Random string by the given options
     * @param  boolean $uppercase    enables uppercase chars
     * @param  boolean $lowercase    enables lowercase chars
     * @param  boolean $specialchars enables special chars
     * @param  int $length           commands the length of the string
     * @return array                 the generated string(s)
     */
    public static function generate($uppercase = false, $lowercase = false, $specialchars = false, $numbers = false, $length = 8, $batchsize = 1)
    {
        if (!$uppercase && !$lowercase && !$specialchars && !$numbers) {
            return [];
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
