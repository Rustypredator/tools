<?php
/**
 * earnpscalc
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
require "../functions.php";
?>
<html>
    <head>
        <title>EarnPsCalc - Rusty's Tools</title>
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
                        <li class="active"><a href="https://tools.rusty.info/tools/earnpscalc">EarnPsCalc <span class="sr-only">(current)</span></a></li>
                        <li><a onclick="save()"><i class="fa fa-lg fa-save"></i>&nbsp;Save</a></li>
                        <li><a onclick="load()"><i class="fa fa-lg fa-upload"></i>&nbsp;Load</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container" style="width:95%;">
            <div class="col-sm-12 col-md-12">
                <?php
                    $content = "<h3>Earnings per Second Calculator</h3><p>With this tool you will be able to calculate how much you are earning per second of a resource.<br/>You can add producers and consumers for different resources (multiple ones per resource are possible too)<br/>You can see an overall gain/loss at the bottom.</p>";
                    printBootstrapPanel("earnpscalc_info", "success", "Info (click me)", $content, true, false);
                ?>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">Producers</div>
                    <div class="panel-body">
                        <button class="btn btn-success btn-sm btn-block" onclick="addproducer()"><i class="fa fa-plus"></i>&nbsp;Add Producer</button>
                        <input type="hidden" value="0" name="pcount" id="pcount"/>
                        <br/>
                        <div id="producersList"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">Consumers</div>
                    <div class="panel-body">
                        <button class="btn btn-success btn-sm btn-block" onclick="addconsumer()"><i class="fa fa-plus"></i>&nbsp;Add Consumer</button>
                        <input type="hidden" value="0" name="ccount" id="ccount"/>
                        <br/>
                        <div id="consumersList"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Result:<button class="btn btn-succes btn-sm pull-right" onclick="recalc()"><i class="fa fa-refresh"></i>&nbsp;Recalculate</button></div>
                    <table class="table table-striped table-hover table-condensed panel-body" id="tableResult">
                        <thead>
                            <th>Resource</th>
                            <th>Production</th>
                            <th>Consumption</th>
                            <th>Gain/Loss</th>
                        </thead>
                        <tbody id="tableResultBody">
                            <tr id="rowRemoveMe">
                                <td colspan="4">--nothing here yet--</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script src="../../style/js/jquery-3.2.1.min.js"></script>
        <script src="../../style/js/bootstrap.min.js"></script>
        <script src="../../style/js/select2.min.js"></script>
        <script src="../../style/js/toastr.min.js"></script>
        <script src="../../style/js/main.js"></script>
        <script>
            function save() {
                alert("not implemented yet");
            }

            function load() {
                alert("not implemented yet");
            }
            
            function addproducer() {
                count = parseInt($('#pcount').val());
                content = "<div class='form-inline' id='p" + count + "'><input class='form-control' type='text' id='p" + count + "_resource' placeholder='name of resource'/><input class='form-control' type='number' id='p" + count + "_amount' placeholder='amount'/> per <input class='form-control' type='number' id='p" + count + "_time' placeholder='0' min='0'/><select class='form-control' id='p" + count +"_timeunit'><option value='s'>Seconds</option><option value='m'>Minutes</option><option value='h'>Hours</option><option value='d'>Days</option></select><button onclick='delitm(\"p" + count + "\")' class='btn btn-danger'><i class='fa fa-trash' ></i></button></div>";
                newnumber = count + 1;
                $('#pcount').val(newnumber);
                $('#producersList').append(content);
            }

            function addconsumer() {
                count = parseInt($('#ccount').val());
                newnumber = count + 1;
                content = "<div class='form-inline' id='c" + newnumber + "'><input class='form-control' type='text' id='c" + newnumber + "_resource' placeholder='name of resource'/><input class='form-control' type='number' id='c" + newnumber + "_amount' placeholder='amount'/> per <input class='form-control' type='number' id='c" + newnumber + "_time' placeholder='0' min='0'/><select class='form-control' id='c" + newnumber +"_timeunit'><option value='s'>Seconds</option><option value='m'>Minutes</option><option value='h'>Hours</option><option value='d'>Days</option></select><button onclick='delitm(\"c" + newnumber + "\")' class='btn btn-danger'><i class='fa fa-trash' ></i></button></div>";
                $('#ccount').val(newnumber);
                $('#consumersList').append(content);
            }

            function recalc() {
                //global vars:
                var prodcons = {};
                var rps = {};
                //producers:
                producers = document.getElementById("producersList").children;
                producersCount = producers.length;
                for (i=0;i<producersCount;i++) {
                    id = producers[i].attributes.id.nodeValue;
                    //get values:
                    resource = $('#' + id + '_resource').val().trim();
                    amount = parseInt($('#' + id + '_amount').val());
                    time = parseInt($('#' + id + '_time').val());
                    unit = $('#' + id + '_timeunit').val();
                    //log:
                    console.log("Producer" + id + ": " + amount + " " + resource + " per " + time + " " + unit);
                    var prod = {resource:resource, amount:amount, time:time, unit:unit};
                    prodcons[id] = prod;
                    //break down to /s
                    if (unit == "s") {
                        seconds = time;
                    } else if (unit == "m") {
                        seconds = time*60; //convert to seconds
                    } else if (unit == "h") {
                        seconds = (time*60)*60; //convert to seconds
                    } else if (unit == "d") {
                        seconds = ((time*24)*60)*60 //convert to seconds
                    }
                    prodpersec = (amount/seconds).toFixed(2); //convert to r/s
                    if (resource in rps) {
                        currentrps = parseInt(rps[resource].rps);
                        currentprod = parseInt(rps[resource].production);
                        //
                        newrps = currentrps + prodpersec;
                        newprod = currentprod + prodpersec;
                        //
                        rps[resource].production = newprod;
                        rps[resource].rps = newrps;
                    } else {
                        rps[resource] = {
                            label: resource,
                            production: prodpersec,
                            consumption: 0,
                            rps: prodpersec
                        };
                    }
                }
                //producers:
                consumers = document.getElementById("consumersList").children;
                consumersCount = consumers.length;
                for (i=0;i<consumersCount;i++) {
                    id = consumers[i].attributes.id.nodeValue;
                    //get values:
                    resource = $('#' + id + '_resource').val().trim();
                    amount = parseInt($('#' + id + '_amount').val());
                    time = parseInt($('#' + id + '_time').val());
                    unit = $('#' + id + '_timeunit').val();
                    //log:
                    console.log("Consumer" + id + ": " + amount + " " + resource + " per " + time + " " + unit);
                    var cons = {resource:resource, amount:amount, time:time, unit:unit};
                    prodcons[id] = cons;
                    //break down to /s
                    if (unit == "s") {
                        seconds = time;
                    } else if (unit == "m") {
                        seconds = time*60; //convert to seconds
                    } else if (unit == "h") {
                        seconds = (time*60)*60; //convert to seconds
                    } else if (unit == "d") {
                        seconds = ((time*24)*60)*60 //convert to seconds
                    }
                    prodpersec = (amount/seconds).toFixed(2); //convert to r/s
                    if (resource in rps) {
                        currentrps = parseInt(rps[resource].rps);
                        currentcons = parseInt(rps[resource].consumption);
                        //
                        newrps = currentrps - prodpersec;
                        newprod = currentcons - prodpersec;
                        //
                        rps[resource].consumption = newprod;
                        rps[resource].rps = newrps;
                    } else {
                        rps[resource] = {
                            label: resource,
                            production: 0,
                            consumption: prodpersec,
                            rps: prodpersec
                        };
                    }
                }

                console.log(prodcons);
                console.log(rps);

                //clear table:
                $('#tableResultBody tr').remove();
                //create table:
                for( r in rps ) {
                    name = rps[r].label;
                    production = rps[r].production;
                    consumption = rps[r].consumption;
                    rs = rps[r].rps;
                    content = "<tr><td>" + name + "</td><td>+" + production + "/s</td><td>" + consumption + "/s</td>";
                    if (rs < 0) {
                        content += "<td><span class='text-danger'><b>" + rs + "</b></span>/s, ";
                        content += "<span class='text-danger'><b>" + (rs*60) + "</b></span>/m, ";
                        content += "<span class='text-danger'><b>" + (rs*60)*60 + "</b></span>/h, ";
                        content += "<span class='text-danger'><b>" + ((rs*60)*60)*24 + "</b></span>/d</td>";
                    } else if ( rs > 0) {
                        content += "<td><span class='text-success'><b>+" + rs + "</b></span>/s, ";
                        content += "<span class='text-success'><b>+" + (rs*60) + "</b></span>/m, ";
                        content += "<span class='text-success'><b>+" + (rs*60)*60 + "</b></span>/h, ";
                        content += "<span class='text-success'><b>+" + ((rs*60)*60)*24 + "</b></span>/d</td>";
                    } else {
                        content += "<td>" + rs + "/s, " + (rs*60) + "/m, " + (rs*60)*60 + "/h, " + ((rs*60)*60)*24 + "/d</td>";
                    }
                    content += "</tr>";
                    $('#tableResultBody').append(content);
                }
            }

            function delitm(itemid) {
                $('#'+itemid).remove();
            }
        </script>
    </body>
    <footer>
    </footer>
</html>
