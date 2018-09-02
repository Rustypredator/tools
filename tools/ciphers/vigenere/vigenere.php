<?php
/**
 * Vigenère Cipher
 * Copyright (C) 2017  rusty.info
 *
 * Git: https://gitlab.com/rustyinfo/vigenerecipher
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
 * @category RustyTools
 * @package  RustyTools_Vigenere
 * @author   Florian Steltenkamp <contact@rusty.info>
 * @license  GNU GPL 3.0
 * @link     https://tools.rusty.info
 */

/**
 * Builds The Vigenere Alphabet Table
 *
 * @param string $alphabetString alphabetstring
 * 
 * @return array alphabet table
 */
function buildAlphabetTable($alphabetString = "ABCDEFGHIJKLMNOPQRSTUVWXYZ")
{
    $alphabetString = strtolower($alphabetString);
    $alphabetArr = str_split($alphabetString);
    $alphabet = array();
    //Create tableau
    for ($i = 0; $i < count($alphabetArr); $i++) {
        if ($i <= 0) {
            array_push($alphabet, $alphabetArr);
            continue; //skip 0
        }
        $sliced = array_slice($alphabetArr, 0, $i);
        $rest = array_slice($alphabetArr, $i);
        foreach ($sliced as $item) {
            array_push($rest, $item);
        }
        array_push($alphabet, $rest);
    }
    return $alphabet;
}

/**
 * Encrypts
 *
 * @param string $content        content to be encrypted
 * @param string $key            key to encrypt with
 * @param array  $alphabet       alphabet
 * @param string $alphabetString alphabet string
 * 
 * @return string
 */
function encrypt($content,$key,$alphabet,$alphabetString)
{
    //Encrypt
    $alphabetString = strtolower($alphabetString);
    $keyIndex = 0;
    $keyArray = str_split($key);
    $contentArray = str_split($content);
    $alphabetStringArray = str_split($alphabetString);
    $newContent = array();
    //iterate content
    foreach ($contentArray as $item) {
        if (in_array($item, array(",",".",";",":"," ","!","\"","§","\$","%","&","/","(",")","=","?"))) {
            array_push($newContent, $item);
            continue; //skip those 
        }
        if ($keyIndex > count($keyArray)-1) {
            $keyIndex = 0; //start key from beginning if end
        }
        //encrypt
        $alphabetIdent = array_search($key[$keyIndex], $alphabetStringArray);
        $newItemAlphabet = $alphabet[$alphabetIdent];
        $newItem = $newItemAlphabet[array_search($item, $alphabetStringArray)];

        //add to arr
        array_push($newContent, $newItem);
        $keyIndex++;
    }
    $finalContent = implode("", $newContent);
    return $finalContent;
}

/**
 * Encrypts
 *
 * @param string $content        content to be encrypted
 * @param string $key            key to encrypt with
 * @param array  $alphabet       alphabet
 * @param string $alphabetString alphabet string
 * 
 * @return string
 */
function decrypt($content,$key,$alphabet,$alphabetString)
{
    $alphabetString = strtolower($alphabetString);
    $alphabetStringArray = str_split($alphabetString);
    $contentArr = str_split($content);
    $keyIndex = 0;
    $keyArray = str_split($key);
    $newContent = array();
    foreach($contentArr as $item) {
        if (in_array($item, array(",",".",";",":"," ","!","\"","§","\$","%","&","/","(",")","=","?"))) {
            array_push($newContent, $item);
            continue; //skip those
        }
        if ($keyIndex > count($keyArray)-1) {
            $keyIndex = 0; //start key from beginning if end
        }
        $keyVal = $key[$keyIndex];
        $rowId = array_search($keyVal,$alphabetStringArray);
        $row = $alphabet[$rowId];
        $alphabetStringIndex = array_search($item,$row);
        $newItem = $alphabetStringArray[$alphabetStringIndex];
        array_push($newContent,$newItem);
        $keyIndex++;
    }
    $finalContent = implode("", $newContent);
    return $finalContent;
}