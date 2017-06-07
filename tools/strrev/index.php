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
        <title>StrRev - Rusty's Tools</title>
        <meta encoding="UTF-8"/>
        <meta title="StrRev - Rusty's Tools" description="Reverse String"/>
        <link rel="stylesheet" href="style/css/bootstrap.min.css" />
        <script src="style/js/jquery-3.2.1.min.js"></script>
        <script src="style/js/bootstrap.min.js"></script>
        <script src="style/js/main.js"></script>
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
                        <li class="active"><a href="https://tools.rusty.info/tools/strrev">StrRev <span class="sr-only">(current)</span></a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <div class="container container-fluid">
            <div class="col-md-12">
                <div class="panel panel-success">
                    <div class="panel-heading" href="#info-collapse" data-target="#info-collapse" data-toggle="collapse">Intro (click me for info)</div>
                    <div class="panel-body collapse" id="info-collapse">
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
            <div class="col-md-12">
                <div class="panel panel-warning">
                    <div class="panel-heading">Your Reversed String:</div>
                    <div class="panel-body">
                        //
                    </div>
                    <div class="panel-footer"></div>
                </div>
            </div>
        </div>
    </body>
    <footer>
    </footer>
</html>
