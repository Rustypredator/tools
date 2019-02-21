<?php
/**
 * pwgen
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
$toolname = "pwgen";

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

?>
<html>
    <head>
        <title>Rusty's Tools - PwGen</title>
        <?php include $templatedir."head/cssfiles.phtml"; ?>
    </head>
    <body>
        <?php
            $additionalNavItems = "<li class='nav-item'><a class='nav-link' href='".$baseurl."'>Home</a></li>";
            $additionalNavItems .= "<li class='nav-item active'><a class='nav-link' href='".$baseurl.$toolname."'>PwGen <span class='sr-only'>(current)</span></a></li>"
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
                            <h3>PWGen</h3>
                            <small>Simple Password Generator</small>
                            <p>
                                This tool allows you, to generate a simple or more complex password. ( or more than one )<br/>
                                Thats basically it, You can choose, wich characters you want to have, and wich length your password should be.<br/>
                                Also you can select to generate more than one Password at a Time, wich is handy, if you want to \"upgrade\" all your accounts ;)
                            </p>
                            <br/>
                            <h4>Guide:</h4>
                            <p>
                                It is very simple to use this Tool.<br/>
                                <ul>Steps:
                                    <li>1. Select what your Password should contain ( using the checkboxes )</li>
                                    <li>2. Select wich length your Password(s) sould be.</li>
                                    <li>3. Select how many Passwords you want to generate at once</li>
                                    <li>4. Push le Button</li>
                                </ul>
                                Thats it. not that hard, right?<br/>
                                I hope this tool will help you as much as it has helped me ;)
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-sm-12">
                    <div class="card text-white bg-dark">
                        <div class="card-header">Generator Settings</div>
                        <div class="card-body">
                            <form class="form" action="" method="post">
                                <label for="uc">Include Uppercase Chars?</label>
                                <input class="form-control" name="uc" type="checkbox"
                                <?php
                                if ($_POST and $_POST['uc']) {
                                    echo "checked";
                                } ?>/>
                                <label for="lc">Include Lowercase Chars?</label>
                                <input class="form-control" name="lc" type="checkbox"
                                <?php
                                if ($_POST and $_POST['lc']) {
                                    echo "checked";
                                } ?>/>
                                <label for="nr">Include Numbers?</label>
                                <input class="form-control" name="nr" type="checkbox"
                                <?php
                                if ($_POST and $_POST['nr']) {
                                    echo "checked";
                                } ?>/>
                                <label for="sc">Include Special Chars?</label>
                                <input class="form-control" name="sc" type="checkbox"
                                <?php
                                if ($_POST and $_POST['sc']) {
                                    echo "checked";
                                } ?>/>
                                <label for="length">Define the Length of your Password(s)</label>
                                <input class="form-control" name="length" type="numeric"
                                <?php
                                if ($_POST and $_POST['length']!="") {
                                    echo "value=\"".$_POST['length']."\"";
                                } else {
                                    echo "value=\"8\"";
                                }?>/>
                                <label for="batch">Select how many Passwords you want</label>
                                <select name="batch" class="form-control">
                                    <option value="1"
                                    <?php
                                    if ($_POST and $_POST['batch']=="1") {
                                        echo "selected";
                                    } ?>>1</option>
                                    <option value="5"
                                    <?php
                                    if ($_POST and $_POST['batch']=="5") {
                                        echo "selected";
                                    } ?>>5</option>
                                    <option value="10"
                                    <?php
                                    if ($_POST and $_POST['batch']=="10") {
                                        echo "selected";
                                    } ?>>10</option>
                                    <option value="15"
                                    <?php
                                    if ($_POST and $_POST['batch']=="15") {
                                        echo "selected";
                                    } ?>>15</option>
                                    <option value="50"
                                    <?php
                                    if ($_POST and $_POST['batch']=="50") {
                                        echo "selected";
                                    } ?>>50</option>
                                    <option value="100"
                                    <?php
                                    if ($_POST and $_POST['batch']=="100") {
                                        echo "selected";
                                    } ?>>100</option>
                                </select>
                                <input type="submit" class="btn btn-block btn-success"/>
                            </form>
                        </div>
                    </div>
                    <?php if ($_POST) : ?>
                        <?php
                        $generated = true;
                        $data = $_POST;

                        //check if at least one option is selected
                        if ((!isset($data['uc']) or !$data['uc']) and (!isset($data['lc']) or !$data['lc']) and (!isset($data['sc']) or !$data['sc']) and (!isset($data['nr']) or !$data['nr'])) {
                            //not one of the options was selected
                            $generated = false;
                        }

                        if (!isset($data['length']) or !is_numeric($data['length']) or $data['length']=="") {
                            $generated = false;
                        }

                        if ($generated and (!isset($data['batch']) or $data['batch']>100)) {
                            $generated = false;
                        }

                        if ($generated) {
                            $generated = generateRandomString($data['uc'], $data['lc'], $data['sc'], $data['nr'], $data['length'], $data['batch']);
                        }
                        ?>
                    <div class="card text-light bg-secondary" style="margin-top:15px;">
                        <div class="card-header">Your Passwords:</div>
                        <table class="card-body table table-hover table-striped text-light">
                            <thead>
                                <th></th>
                                <th>Password</th>
                            </thead>
                            <tbody>
                                <?php if (!$generated) : ?>
                                    <tr><td><div class="alert alert-error"><i class="fa fa-lg fa-times-circle"></i> There was an Error with your Input! Please try again!</div></td></tr>
                                <?php else : ?>
                                    <?php foreach ($generated as $pw) : ?>
                                        <tr><td></td><td><?php echo $pw; ?></td></tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading"></div>
                            
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php include $templatedir."head/jsfiles.phtml"; ?>
    </body>
</html>