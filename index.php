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
require "init.php";
$toolname = "";
?>
<html>
    <head>
        <title>Rusty's Tools</title>
        <?php include $templatedir."head/cssfiles.phtml"; ?>
    </head>
    <body>
        <?php $additionalNavItems = "<li class='nav-item active'><a class='nav-link' href='https://tools.rusty.info'>Home <span class='sr-only'>(current)</span></a></li>"; ?>
        <?php $additionalNavItemsRight = ""; ?>
        <?php include $templatedir."navbar.phtml"; ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-sm-12">
                    <?php include $templatedir."toolnav.phtml"; ?>
                </div>
                <div class="col-md-9 col-sm-12">
                    <div class="card text-white bg-dark">
                        <div class="card-header">Welcome</div>
                        <div class="card-body">
                            <p>
                                Welcome to my little collection of (hopefully) useful tools.<br/>
                                There are not many yet, but this collection will continue to grow because i make these tools whenever i need them.<br/>
                                If you have ideas for useful simple tools you have'nt found yet on the interwebs, feel free to contact me: <a href="mailto:contact@rusty.info">E-Mail</a><br/>
                                <br/>
                                Feel free to browse a little and hopefully you will find something useful ;)
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include $templatedir."head/jsfiles.phtml"; ?>
    </body>
</html>
