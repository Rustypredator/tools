<?php
/**
 * secompcalc
 * Copyright (C) 2017  rusty.info
 *
 * Git: https://gitlab.com/rustyinfo/secompcalc
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

$partlist_json = file_get_contents("parts.json");
$partlist_object = json_decode($partlist_json);
?>
<html>
    <head>
        <title>SECompCalc - Rusty's Tools</title>
        <link rel="stylesheet" href="../../style/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="../../style/css/font-awesome.min.css"/>
        <link rel="stylesheet" href="../../style/css/select2.min.css"/>
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
                        <li class="active"><a href="https://tools.rusty.info/tools/secompcalc">SECompCalc <span class="sr-only">(current)</span></a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <div class="container container-fluid">
            <div class="col-md-12">
                <?php
                    $content = "<h3>SpaceEngineers Component Calculator</h3><p>This tool allows you to calculate all the components and raw resources you will need for your build.<br/>Just add the blocks you need and watch as the tool calculates what components you will need.<br/>Feedback welcome!</p>";
                    printBootstrapPanel("secompcalc_info", "success", "Info (click me)", $content, true, false);
                ?>
            </div>
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">Add Blocks</div>
                    <div class="panel-body">
                        <form method="" action="">
                            <div class="col-sm-8">
                                <select id="partpicker-part" name="part" class="part-selector form-control">
                                    <option value="null">-- Select Part to add --</option>
                                    <?php foreach ($partlist_object->blocks as $block): ?>
                                    <?php
                                        $ident = $block->ident;
                                        $label = $block->label;
                                        $ingredients = $block->ingredients;
                                    ?>
                                    <option value="<?php echo $label; ?>"><?php echo $label; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <select id="partpicker-gridsize" name="gridsize" class="gridsize-selector form-control">
                                    <option value="large">Large</option>
                                    <option value="small">Small</option>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <input type="number" value="1" min="1" max="1000" class="form-control"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="../../style/js/jquery-3.2.1.min.js"></script>
        <script src="../../style/js/bootstrap.min.js"></script>
        <script src="../../style/js/select2.min.js"></script>
        <script src="../../style/js/main.js"></script>
        <script>
            $(document).ready(function() {
                $('.part-selector').select2({theme: "classic"});
                $('.gridsize-selector').select2({theme: "classic"});
            });
        </script>
    </body>
    <footer>
    </footer>
</html>
