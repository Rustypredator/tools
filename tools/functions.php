<?php

//libs:
require_once "lib/printBootstrapElements.php";

/**
 * Generates a Random string by the given options
 * @param  boolean $uppercase    enables uppercase chars
 * @param  boolean $lowercase    enables lowercase chars
 * @param  boolean $specialchars enables special chars
 * @param  int $length           commands the length of the string
 * @return array                 the generated string(s)
 */
function generateRandomString($uppercase, $lowercase, $specialchars, $numbers, $length, $batchsize)
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