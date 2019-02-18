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
?>
<html>
    <head>
        <title>StColIDs - Rusty's Tools</title>
        <meta encoding="UTF-8"/>
        <meta title="StColIDs - Rusty's Tools" description="Tool to extract Mod-IDs from Steam collections"/>
        <link rel="stylesheet" href="../../style/css/bootstrap.min.css" />
        <link rel="stylesheet" href="../../style/css/font-awesome.min.css" />
        <script src="../../style/js/jquery-3.2.1.min.js"></script>
        <script src="../../style/js/bootstrap.min.js"></script>
        <script src="main.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="https://tools.rusty.info">Rusty's Tools</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="https://tools.rusty.info/tools/stcolids">StColIDs <span class="sr-only">(current)</span></a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <div class="container container-fluid">
            <div class="col-md-12">
                <div class="panel panel-success">
                    <div class="panel-heading" href="#info-collapse" data-target="#info-collapse" data-toggle="collapse">Intro (click me for info)</div>
                    <div class="panel-body collapse" id="info-collapse">
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
            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">Collection</div>
                    <div class="panel-body">
                        <label for="collection">Collection-ID:</label>
                        <input class="form-control" type="text" name="collection" id="form_collection"/>
                        <br/>
                        <button onclick="pull_collection()" class="btn btn-block btn-info">Get Mod-Ids</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-info">
                    <div class="panel-heading">Raw ( only IDs)</div>
                    <div class="panel-body">
                        <textarea id="raw_ids" rows="6" class="form-control"></textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="panel panel-warning">
                    <div class="panel-heading">Found <span class="badge badge-info" id="badge_count"></span> Workshop Items</div>
                    <table class="panel-body table table-hover table-striped">
                        <thead>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Url</th>
                        </thead>
                        <tbody id="table_fillme">
                            <tr id="table_removeme"><td colspan="3"><span class="text-center">nothing here yet</span></td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
    <footer>
    </footer>
</html>
