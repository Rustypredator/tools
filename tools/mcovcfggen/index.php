<?php
/**
 * McOvCFGGen
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
$toolname = "mcovcfggen";
$toolDescShort = "";
?>
<html>
    <?php include $templatedir."head/head.phtml"; ?>
    <body>
        <?php
            $additionalNavItems = "<li class='nav-item'><a class='nav-link' href='".$baseurl."'>Home</a></li>";
            $additionalNavItems .= "<li class='nav-item active'><a class='nav-link' href='".$baseurl.$toolname."'>McOvCFGGen <span class='sr-only'>(current)</span></a></li>"
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
                            <p>
                                If You already Have generated a Config file with this Tool,
                                You propably have saved the config file that was available for download at the end.
                            </p>
                            <p>
                                You can (not yet) use that config file here, to restore all your previous settings
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-sm-12">
                    <div class="row" style="margin-bottom:15px;">
                        <div class="col-sm-12 col-md-6">
                            <div class="card text-light bg-dark">
                                <div class="card-header">Worlds</div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <input class="form-control" type="text" id="newWorldName" placeholder="name"/>
                                        </div>
                                        <div class="col-md-4">
                                            <input class="form-control" type="text" id="newWorldPath" placeholder="path"/>
                                        </div>
                                        <div class="col-md-4">
                                            <button class="btn btn-success" onclick="addworld()"><i class="fa fa-plus"></i>&nbsp;Add World</button>
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-hover table-condensed card-body text-light">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Path</th>
                                            <th>RenderType</th>
                                        </tr>
                                    </thead>
                                    <tbody id="worldsList"><tr><td colspan="3"></td></tr></tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="card text-light bg-dark">
                                <div class="card-header">{title}</div>
                                <div class="card-body">
                                    {content}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card text-light bg-dark" style="margin-bottom:15px;">
                        <div class="card-header">Renders</div>
                        <div class="card-body">
                            <p>
                                Select a world you added from the dropdown below and specify the parameters of the render. if you dont want a specific parameter, just leave it free.
                            </p>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <select id="newRenderWorld">
                                        <option value="none" selected>--Add a world first!--</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-success" onclick="addrender()"><i class="fa fa-plus"></i>&nbsp;Add Render</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card text-light bg-secondary">
                        <div class="card-header"><button class="btn btn-primary btn-sm" onclick="recalc()"><i class="fa fa-sync"></i></button>&nbsp;&nbsp;Config Output</div>
                        <div class="card-body">
                            <pre>
                                <code class="json">
worlds["My world"] = "/home/username/server/world"

renders["normalrender"] = {
    "world": "My world",
    "title": "Normal Render of My World",
}

outputdir = "/home/username/mcmap"
texturepath="/full/path/to/texturepack.zip"
                                </code>
                            </pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include $templatedir."head/jsfiles.phtml"; ?>
        <script>
            function addWorld() {
                //
                //repopulate worldselection in render
            }

            function addMarker() {
                //
            }

            function addRender() {
                //
            }

            function recalc() {
                //
            }
        </script>
    </body>
</html>