<?php
/**
 * StrRev
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
$toolname = "StrRev";
$toolshort = strtolower($toolname);
$toolDescShort = "Reverse String";
?>
<html>
    <?php include $templatedir."head/head.phtml"; ?>
    <body>
        <?php
            $additionalNavItems = "<li class='nav-item'><a class='nav-link' href='".$baseurl."'>Home</a></li>";
            $additionalNavItems .= "<li class='nav-item active'><a class='nav-link' href='".$baseurl.$toolshort."'><?php echo $toolname; ?> <span class='sr-only'>(current)</span></a></li>"
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
                            <h3>StrRev</h3><small>String Reverse</small>
                            <p>
                                This Tool Allows you to Reverse an input.
                            </p><br/>
                            <h4>Guide:</h4>
                            <p>
                                It is very simple to use this Tool.<br/>
                            <ul>Steps:
                                <li>1. Put your String in the field</li>
                                <li>2. Push le button...</li>
                            </ul>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-sm-12">
                    <div class="card text-white bg-dark">
                        <div class="card-header">Input:</div>
                        <div class="card-body">
                            <textarea id="strInput" class="form-control" rows="4" onchange="reverse()">-- put your text here --</textarea>
                        </div>
                    </div>
                    <div class="card text-light bg-secondary" style="margin-top: 15px;">
                        <div class="card-header">Output:</div>
                        <div class="card-body">
                            <textarea id="strOutput" class="form-control" rows="10">-- your reversed string will appear here --</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include $templatedir."head/jsfiles.phtml"; ?>
        <script>
            $("#strInput").on("change input paste keyup", function() {
                $("#strOutput").html(jQuery(this).val().split("").reverse().join(""));
            });
        </script>
    </body>
</html>