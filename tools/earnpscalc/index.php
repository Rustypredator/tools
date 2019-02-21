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
require "../../init.php";
$toolname = "EarnPsCalc";
$toolshort = strtolower($toolname);
$toolDescShort = "";
?>
<html>
<?php include $templatedir."head/head.phtml"; ?>
    <body>
        <?php
            $additionalNavItems = "<li class='nav-item'><a class='nav-link' href='".$baseurl."'>Home</a></li>";
            $additionalNavItems .= "<li class='nav-item active'><a class='nav-link' href='".$baseurl.$toolshort."'>$toolname <span class='sr-only'>(current)</span></a></li>"
        ?>
        <?php
            $additionalNavItemsRight = "<li><a onclick='save()'><i class='fa fa-lg fa-save'></i>&nbsp;Save</a></li>";
            $additionalNavItemsRight .= "<li><a onclick='load()'><i class='fa fa-lg fa-upload'></i>&nbsp;Load</a></li>";
        ?>
        <?php include $templatedir."navbar.phtml"; ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-sm-12">
                    <?php include $templatedir."toolnav.phtml"; ?>
                    <div class="card text-white bg-success" style="margin-top:15px;">
                        <div class="card-header collapsed" type="button" data-toggle="collapse" data-target="#infoCollapse" aria-expanded="false" aria-controls="infoCollapse">INFO ( Click me! )</div>
                        <div class="card-body collapse" id="infoCollapse">
                            <h3>Earnings per Second Calculator</h3>
                            <p>
                                With this tool you will be able to calculate how much you are earning per second of a resource.<br/>
                                You can add producers and consumers for different resources (multiple ones per resource are possible too)<br/>
                                You can see an overall gain/loss at the bottom.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-sm-12">
                    <div class="row" style="margin-bottom:15px;">
                        <div class="col-md-6 col-sm-12">
                            <div class="card text-white bg-dark">
                                <div class="card-header">Producers</div>
                                <div class="card-body">
                                    <button class="btn btn-success btn-sm btn-block" onclick="addproducer()"><i class="fa fa-plus"></i>&nbsp;Add Producer</button>
                                    <input type="hidden" value="0" name="pcount" id="pcount"/>
                                    <br/>
                                    <div id="producersList"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="card text-white bg-dark">
                                <div class="card-header">Consumers</div>
                                <div class="card-body">
                                    <button class="btn btn-success btn-sm btn-block" onclick="addconsumer()"><i class="fa fa-plus"></i>&nbsp;Add Consumer</button>
                                    <input type="hidden" value="0" name="ccount" id="ccount"/>
                                    <br/>
                                    <div id="consumersList"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card text-light bg-secondary">
                        <div class="card-header"><button class="btn btn-primary btn-sm content-justify-end" onclick="recalc()"><i class="fa fa-sync"></i></button>&nbsp;&nbsp;Results:</div>
                        <table class="table table-striped table-hover table-condensed card-body" id="tableResult">
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
        </div>
        <?php include $templatedir."head/jsfiles.phtml"; ?>
        <script>
            function save() {
                alert("not implemented yet");
            }

            function load() {
                alert("not implemented yet");
            }
            
            function addproducer() {
                count = parseInt($('#pcount').val());
                content = "<div class='form-group form-group row' id='p" + count + "'><div class='col-sm-4'><input class='form-control' type='text' id='p" + count + "_resource' placeholder='name of resource'/></div><div class='col-sm-2'><input class='form-control' type='number' id='p" + count + "_amount' placeholder='amount'/></div><div class='col-sm-1'> per </div><div class='col-sm-2'><input class='form-control' type='number' id='p" + count + "_time' placeholder='0' min='0'/></div><div class='col-sm-2'><select id='p" + count +"_timeunit'><option value='s'>Seconds</option><option value='m'>Minutes</option><option value='h'>Hours</option><option value='d'>Days</option></select></div><div class='col-sm-1'><button onclick='delitm(\"p" + count + "\")' class='btn btn-danger'><i class='fa fa-trash' ></i></button></div></div>";
                newnumber = count + 1;
                $('#pcount').val(newnumber);
                $('#producersList').append(content);
                //refresh selects
                $('#p'+count+"_timeunit").select2();
            }

            function addconsumer() {
                count = parseInt($('#ccount').val());
                newnumber = count + 1;
                content = "<div class='form-group form-group row' id='c" + newnumber + "'><div class='col-sm-4'><input class='form-control' type='text' id='c" + newnumber + "_resource' placeholder='name of resource'/></div><div class='col-sm-2'><input class='form-control' type='number' id='c" + newnumber + "_amount' placeholder='amount'/></div><div class='col-sm-1'> per </div><div class='col-sm-2'><input class='form-control' type='number' id='c" + newnumber + "_time' placeholder='0' min='0'/></div><div class='col-sm-2'><select id='c" + newnumber +"_timeunit'><option value='s'>Seconds</option><option value='m'>Minutes</option><option value='h'>Hours</option><option value='d'>Days</option></select></div><div class='col-sm-1'><button onclick='delitm(\"c" + newnumber + "\")' class='btn btn-danger'><i class='fa fa-trash' ></i></button></div></div>";
                $('#ccount').val(newnumber);
                $('#consumersList').append(content);
                $('#c'+count+"_timeunit").select2();
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
                    prodpersec = parseFloat((amount/seconds).toFixed(2)); //convert to r/s
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
                    prodpersec = parseFloat((amount/seconds).toFixed(2)); //convert to r/s
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
                        content += "<td><span class='text-danger'><b>" + parseFloat((rs).toFixed(2)) + "</b></span>/s, ";
                        content += "<span class='text-danger'><b>" + parseFloat((rs*60).toFixed(2)) + "</b></span>/m, ";
                        content += "<span class='text-danger'><b>" + parseFloat(((rs*60)*60).toFixed(2)) + "</b></span>/h, ";
                        content += "<span class='text-danger'><b>" + parseFloat((((rs*60)*60)*24).toFixed(2)) + "</b></span>/d</td>";
                    } else if ( rs > 0) {
                        content += "<td><span class='text-success'><b>+" + parseFloat((rs).toFixed(2)) + "</b></span>/s, ";
                        content += "<span class='text-success'><b>+" + parseFloat(((rs*60)).toFixed(2)) + "</b></span>/m, ";
                        content += "<span class='text-success'><b>+" + parseFloat(((rs*60)*60).toFixed(2)) + "</b></span>/h, ";
                        content += "<span class='text-success'><b>+" + parseFloat((((rs*60)*60)*24).toFixed(2)) + "</b></span>/d</td>";
                    } else {
                        content += "<td><b>+" + parseFloat((rs).toFixed(2)) + "</b>/s, ";
                        content += "<b>+" + parseFloat(((rs*60)).toFixed(2)) + "</b>/m, ";
                        content += "<b>+" + parseFloat(((rs*60)*60).toFixed(2)) + "</b>/h, ";
                        content += "<b>+" + parseFloat((((rs*60)*60)*24).toFixed(2)) + "</b>/d</td>";
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
</html>