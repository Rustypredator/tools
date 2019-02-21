<?php
/**
 * morsetranslate
 * Copyright (C) 2017  rusty.info
 *
 * Git: https://gitlab.com/rustyinfo/tools-homepage
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
require "../../init.php";

$alphabet = array(
    //alphabet
    'a' => '.-',
    'b' => '-...',
    'c' => '-.-.',
    'd' => '-..',
    'e' => '.',
    'f' => '..-.',
    'g' => '--.',
    'h' => '....',
    'i' => '..',
    'j' => '.---',
    'k' => '-.-',
    'l' => '.-..',
    'm' => '--',
    'n' => '-.',
    'o' => '---',
    'p' => '.--.',
    'q' => '--.-',
    'r' => '.-.',
    's' => '...',
    't' => '-',
    'u' => '..-',
    'v' => '...-',
    'w' => '.--',
    'x' => '-..-',
    'y' => '-.--',
    'z' => '--..',
    //numbers
    '1' => '.----',
    '2' => '..---',
    '3' => '...--',
    '4' => '....-',
    '5' => '.....',
    '6' => '-....',
    '7' => '--...',
    '8' => '---..',
    '9' => '----.',
    '0' => '-----',
    //Special chars and punctuation
    '' => '.--.-',
    '' => '.-.-',
    '' => '.-..-',
    '' => '..-..',
    '' => '---.',
    '' => '..--',
    '' => '...--..',
    '' => '----',
    '' => '--.--',
    '.' => '.-.-.-',
    ',' => '--..--',
    ':' => '---...',
    ';' => '-.-.-.',
    '?' => '..--..',
    '-' => '-....-',
    '_' => '..--.-',
    '(' => '-.--.',
    ')' => '-.--.-',
    '\'' => '.----.',
    '=' => '-...-',
    '+' => '.-.-.',
    '/' => '-..-.',
    '@' => '.--.-.',
    //Signals
    '(start)' => '-.-.-',
    '(pause)' => '-...-',
    '(end)' => '.-.-.',
    '(understood)' => '...-.',
    '(com-end)' => '...-.',
    'sos' => '...---...',
    '(error/repeat)' => '........'
);

$toolname = "MorseTranslate";
$toolshort = strtolower($toolname);
$toolDescShort = "";
?>
<html>
<?php include $templatedir."head/head.phtml"; ?>
    <body>
        <?php
            $additionalNavItems = "<li class='nav-item'><a class='nav-link' href='".$baseurl."'>Home</a></li>";
            $additionalNavItems .= "<li class='nav-item active'><a class='nav-link' href='".$baseurl.$toolname."'><?php echo $toolname; ?> <span class='sr-only'>(current)</span></a></li>"
        ?>
        <?php $additionalNavItemsRight = ""; ?>
        <?php include $templatedir."navbar.phtml"; ?>
        <div class="container-fluid">
            <div class="row">
            <div class="col-md-3 col-sm-12">
                    <?php include $templatedir."toolnav.phtml"; ?>
                    <div class="card text-white bg-success" style="margin-top:15px;">
                        <div class="card-header collapsed" type="button" data-toggle="collapse" data-target="#infoCollapse" aria-expanded="false" aria-controls="infoCollapse">INFO ( Click me! )</div>
                        <div class="card-body collapse" id="infoCollapse">
                            This tool is currently WIP!
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-sm-12">
                    <div class="card text-white bg-dark">
                        <div class="card-header">{title}</div>
                        <div class="card-body">
                            {content}
                        </div>
                    </div>
                    <div class="card text-light bg-secondary" style="margin-top:15px;">
                        <div class="card-header">{title}</div>
                        <div class="card-body">
                            {content}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include $templatedir."head/jsfiles.phtml"; ?>
    </body>
</html>
