<?php
    /**
     * stcolids
     * Copyright (C) 2017  rusty.info
     *
     * Git: https://gitlab.com/rustyinfo/stcolids
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
        <title>McOvCFGGen - Rusty's Tools</title>
        <meta encoding="UTF-8"/>
        <meta title="McOvCFGGen - Rusty's Tools" description="Configuration Generator for The Minecraft Overviewer"/>
        <link rel="stylesheet" href="../../style/css/bootstrap.min.css" />
        <script src="../../style/js/jquery-3.2.1.min.js"></script>
        <script src="../../style/js/bootstrap.min.js"></script>
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
                        <li class="active"><a href="https://tools.rusty.info/tools/McOvCFGGen">McOvCFGGen <span class="sr-only">(current)</span></a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <div class="container container-fluid">
            <div class="col-md-12">
                <div class="panel panel-success">
                    <div class="panel-heading" href="#info-collapse" data-target="#info-collapse" data-toggle="collapse">Intro (click me for info)</div>
                    <div class="panel-body collapse" id="info-collapse">
                        <p>
                            If You already Have generated a Config file with this Tool,
                            You propably have saved the config file that was available for download at the end.
                        </p>
                        <p>
                            You can use that config file here, to restore all your previous settings:
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="panel-group" id="config-tabs" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading_load" data-toggle="collapse" data-parent="#config-tabs" href="#collapse_load" aria-expanded="false" aria-controls="collapse_load">Load existing Config</div>
                        <div class="collapse in" id="collapse_load" role="tabpanel" aria-labelledby="heading_load">
                            <div class="panel-body" >
                                <label for="config">Existing Config File:</label>
                                <input type="file" name="config" class="form-control"/>
                            </div>
                            <div class="panel-footer"></div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading_worlds" data-toggle="collapse" data-parent="#config-tabs" href="#collapse_worlds" aria-expanded="false" aria-controls="collapse_worlds">Define your Worlds</div>
                        <div class="collapse in" id="collapse_worlds" role="tabpanel" aria-labelledby="heading_worlds">
                            <div class="panel-body" >
                                {WORLDS}
                            </div>
                            <div class="panel-footer"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <footer>
    </footer>
</html>
