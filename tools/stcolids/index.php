<?php
/**
 * stcolids
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
$toolname = "StColIDs";
$toolshort = strtolower($toolname);
$toolDescShort = "";
?>
<!DOCTYPE html>
<html lang="en">
    <?php include $templatedir."head/head.phtml"; ?>
    <body>
        <?php
        $additionalNavItems = "<li class='nav-item'><a class='nav-link' href='".$baseurl."'>Home</a></li>";
        $additionalNavItems .= "<li class='nav-item active'><a class='nav-link' href='".$baseurl.$toolshort."'>$toolname <span class='sr-only'>(current)</span></a></li>"
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
                            <h3>StColIDs</h3><small>Steam Collection IDs</small>
                            <p>
                                This tool allows you, to extract all Workshop mod IDs from a Collection.<br/>
                                This is <b>very</b> usefull for Games like Space Engineers where you have to put in a list of mods into the server config<br/>
                                ( at least for the dedicated servers )<br/>
                                Feel free to use it for whatever reason, Spaceengineers was why i buildt this tool.<br/>
                            </p><br/>
                            <h4>Guide:</h4>
                            <p>
                                It is very simple to use this Tool.<br/>
                                <ul>Steps:
                                    <li>1. Get the Link to your Collection</li>
                                    <li>2. grab <b>only</b> the ID at the end.</li>
                                    <li>3. Put this id into the "ID" field</li>
                                    <li>4. Push le button</li>
                                </ul>
                                Thats it. not that hard, right?<br/>
                                I hope this tool will help you as much as it has helped me ;)
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-sm-12">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="card text-white bg-dark">
                                <div class="card-header">Input</div>
                                <div class="card-body">
                                    <label for="collection">Collection-ID:</label>
                                    <input class="form-control" type="text" name="collection" id="form_collection"/>
                                    <br/>
                                    <button onclick="pull_collection()" class="btn btn-block btn-info">Get Mod-Ids</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="card text-light bg-secondary">
                                <div class="card-header">Raw ( only IDs)</div>
                                <div class="card-body">
                                    <textarea id="rawIds" rows="4" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card text-light bg-secondary" style="margin-top: 15px;">
                        <div class="card-header">Found <span class="badge badge-info" id="badgeCount">0</span> Workshop Items</div>
                        <table class="card-body table table-hover table-striped text-light">
                            <thead>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Url</th>
                            </thead>
                            <tbody id="workshopItemsTable">
                                <tr><td colspan="3"><span class="text-center">nothing here yet</span></td></tr>
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include $templatedir."head/jsfiles.phtml"; ?>
        <script>
            function pull_collection() {
                collectionid = $('#form_collection').val();
                if (collectionid=="") {
                    alert("Please fill out the ID Field in the form!");
                    exit;
                } else {
                    dataString = "collection="+collectionid;
                    $.ajax (
                        {
                            type: 'POST',
                            url: toolurl + 'ajax/getcol.php',
                            data: dataString,
                            cache: false,
                            beforeSend: function() {
                                //exec before sending
                            },
                            success: function(data) {
                                //on message recieved
                                var obj = JSON.parse(data);
                                if (obj.type == 'success') {
                                    //get steam stuff successfull
                                    $('#workshopItemsTable tr').remove();
                                    $('#badgeCount').html(obj.modscount);
                                    $('#rawIds').html("");
                                    var modsdata = obj.modsdata;
                                    modsdata.forEach(function(entry) {
                                        let row = '<tr><td>'+entry.id+'</td><td>'+entry.name+'</td><td><a href="'+entry.url+'">Workshop Link</a></td></tr>';
                                        $('#rawIds').append(entry.id+'\n');
                                        $('#workshopItemsTable').append(row);
                                    });
                                } else {
                                    //failed. display message
                                    alert(obj.message);
                                }
                            }
                        }
                    )
                }
            }
        </script>
    </body>
</html>