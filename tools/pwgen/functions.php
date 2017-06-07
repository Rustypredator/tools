<?php
/**
 * stcolids
 * Copyright (C) 2017  rusty.info
 *
 * Git: https://gitlab.com/rustyinfo/pwgen
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @author Florian Steltenkamp <contact@rusty.info>
 */

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
