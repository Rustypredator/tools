<?php
/**
 * tools-homepage
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
        <title>Rusty's Tools</title>
        <link rel="stylesheet" href="style/css/font-awesome.min.css"/>
        <link rel="stylesheet" href="style/css/bootstrap.min.css"/>
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
                        <li class="active"><a href="https://tools.rusty.info/">Home <span class="sr-only">(current)</span></a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <div class="container container-fluid">
            <div class="col-md-3 col-sm-12">
                <div class="panel panel-info">
                    <div class="panel-heading">Tools</div>
                    <div class="panel-body">
                        <ul>
                            <li>
                                <i id="toolslist-info-button-1" data-toggle="popover" title="Password-Generator" data-content="A Simple Password generator with options to choose how complex your password will be." class="fa fa-info-circle"></i>&nbsp;
                                <a href="https://tools.rusty.info/tools/pwgen">Password-Generator</a>
                            </li>
                            <li>
                                <i id="toolslist-info-button-2" data-toggle="popover" title="Collection-ID grabber" data-content="Tool to extract all ids from a workshop collection (steam)" class="fa fa-info-circle"></i>&nbsp;
                                <a href="https://tools.rusty.info/tools/stcolids">StColIDs</a>
                            </li>
                            <li>
                                <i id="toolslist-info-button-3" data-toggle="popover" title="Team Mix" data-content="Tool to create Mixed Teams from a List of Names" class="fa fa-info-circle"></i>&nbsp;
                                <a href="https://tools.rusty.info/tools/TeamMix">TeamMix</a>
                            </li>
                            <ul>Ciphers
                                <li>
                                    <i id="toolslist-info-button-4" data-toggle="popover" title="Ceasar Cipher" data-content="Ceasar Cipher" class="fa fa-info-circle"></i>&nbsp;
                                    <a href="https://tools.rusty.info/tools/ciphers/ceasar">Ceasar Cipher</a>
                                </li>
                                <li>
                                    <i id="toolslist-info-button-5" data-toggle="popover" title="Vigenère Cipher" data-content="Vigenère Cipher" class="fa fa-info-circle"></i>&nbsp;
                                    <a href="https://tools.rusty.info/tools/ciphers/ceasar">Vigenère Cipher</a>
                                </li>
                            </ul>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">Welcome</div>
                    <div class="panel-body">
                        <p>
                            Welcome to my little collection of (hopefully) useful tools.<br/>
                            There are not many yet, but this collection will continue to grow because i make these tools whenever i need them.<br/>
                            If you have ideas for useful simple tools you have'nt found yet on the interwebs, feel free to contact me: <a href="mailto:contact@rusty.info">E-Mail</a><br/>
                            <br/>
                            Feel free to browse a little and hopefully you will find something useful ;)
                        </p>
                    </div>
                    <div class="panel-footer"></div>
                </div>
            </div>
        </div>
    </body>
</html>
