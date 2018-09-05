<?php
/**
 * pwgen
 * Copyright (C) 2017  rusty.info
 *
 * Git: https://gitlab.com/rustyinfo/pwgen
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
require_once("../functions.php");
?>
<html>
    <head>
        <title>PWGen - Rusty's Tools</title>
        <link rel="stylesheet" href="../../style/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="../../style/css/font-awesome.min.css"
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
                        <li class="active"><a href="https://tools.rusty.info/tools/pwgen">PWGen <span class="sr-only">(current)</span></a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <div class="container container-fluid">
            <div class="col-md-12">
                <?php
                    $content = "<h3>PWGen</h3><small>Simple Password Generator</small><p>This tool allows you, to generate a simple or more complex password. ( or more than one )<br/>Thats basically it, You can choose, wich characters you want to have, and wich length your password should be.<br/>Also you can select to generate more than one Password at a Time, wich is handy, if you want to \"upgrade\" all your accounts ;)</p><br/><h4>Guide:</h4><p>It is very simple to use this Tool.<br/><ul>Steps:<li>1. Select what your Password should contain ( using the checkboxes )</li><li>2. Select wich length your Password(s) sould be.</li><li>3. Select how many Passwords you want to generate at once</li><li>4. Push le Button</li></ul>Thats it. not that hard, right?<br/>I hope this tool will help you as much as it has helped me ;)</p>";
                    printBootstrapPanel("pwgen_info","success","Info (click me)",$content,true,false);
                ?>
            </div>
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">Generator Settings</div>
                    <div class="panel-body">
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
                        </div>
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
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">Your Passwords</div>
                            <table class="panel-body table table-hover table-striped">
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
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </body>
    <footer>
    </footer>
</html>
