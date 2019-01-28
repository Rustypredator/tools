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
        <link rel="stylesheet" href="../../style/css/main.css"/>
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
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="https://tools.rusty.info/tools/secompcalc">SECompCalc <span class="sr-only">(current)</span></a></li>
                    </ul>
                </div>
            </div>
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
                        <p>
                            Select a Part from the List below and click the "Add" Button to add it to the list.
                        </p>
                        <div class="col-sm-6">
                            <select id="partpicker-part" name="part" class="part-selector form-control">
                                <option value="null">-- Select Part to add --</option>
                                <?php foreach ($partlist_object->blocks as $block): ?>
                                <?php
                                    $ident = $block->ident;
                                    $label = $block->label;
                                    $ingredients = $block->ingredients;
                                ?>
                                <option value="<?php echo $ident; ?>"><?php echo $label; ?></option>
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
                            <input id="partpicker-amount" type="number" value="1" min="1" max="1000" class="form-control"/>
                        </div>
                        <div class="col-sm-2">
                            <button class="btn btn-success"><i class="fa fa-lg fa-plus" onclick="addpart()"></i>&nbsp;Add</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="panel panel-info">
                    <div class="panel-heading">Added Blocks (newest on top)</div>
                    <table class="panel-body table table-striped table-condensed table-hover" id="partlist">
                        <thead>
                            <th>Name</th>
                            <th>Amount</th>
                            <th>Size</th>
                            <th>Actions</th>
                        </thead>
                        <tbody id="partlist_tbody">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="panel panel-success">
                    <div class="panel-heading">Parts needed:<button class="pull-right btn btn-success btn-sm"><i class="fa fa-lg fa-refresh"></i>&nbsp;Recalculate</button></div>
                    <div class="panel-body">
                        -
                    </div>
                </div>
            </div>
        </div>
        <script src="../../style/js/jquery-3.2.1.min.js"></script>
        <script src="../../style/js/bootstrap.min.js"></script>
        <script src="../../style/js/select2.min.js"></script>
        <script src="../../style/js/toastr.min.js"></script>
        <script src="../../style/js/main.js"></script>
        <script>
            $(document).ready(function() {
                $('.part-selector').select2();
                $('.gridsize-selector').select2();
            });
            let blocklist = {"large": {}, "small": {}};
            function calculateparts() {
                $('#partscost').html("lol");
            }
            function populatetable() {
                //debug
                console.log(blocklist);
                //clear table
                document.getElementById("partlist_tbody").innerHTML = "";
                //cycle blocklist
                for (block in blocklist["small"]) {
                    let row = "<tr><td>"+block.ident+"</td><td>"+block.amount+"</td><td>small</td><td>actions here</td></tr>";
                    $('#partlist_tbody:last-child').append(row);
                }
                for (block in blocklist["large"]) {
                    obj = blocklist["large"][block];
                    let row = "<tr><td>"+obj.ident+"</td><td>"+obj.amount+"</td><td>large</td><td>actions here</td></tr>";
                    $('#partlist_tbody:last-child').append(row);
                }
            }
            function addpart() {
                let partident = $('#partpicker-part').val();
                let partsize = $('#partpicker-gridsize').val();
                let amount = $('#partpicker-amount').val();
                if (partident in blocklist[partsize]) {
                    //update amount
                    let oldamount = blocklist[partsize][partident].amount;
                    blocklist[partsize][partident].amount = oldamount + amount;
                } else {
                    blocklist[partsize][partident] = {
                        "ident": partident,
                        "amount": amount
                    }
                }
                let msg = "adding "+amount+" of "+partident+" size: "+partsize;
                populatetable();
                calculateparts();
                toastr["success"]("title", msg);
            }
        </script>
    </body>
    <footer>
    </footer>
</html>
