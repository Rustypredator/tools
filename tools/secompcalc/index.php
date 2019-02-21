<?php
/**
 * secompcalc
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
$toolname = "SeCompCalc";
$partlist_object = json_decode(file_get_contents("parts.json"));
$toolshort = strtolower($toolname);
$toolDescShort = "";
?>
<html>
<?php include $templatedir."head/head.phtml"; ?>
    <body>
        <?php
            $additionalNavItems = "<li class='nav-item'><a class='nav-link' href='".$baseurl."'>Home</a></li>";
            $additionalNavItems .= "<li class='nav-item active'><a class='nav-link' href='".$baseurl.$toolname."'><?php echo $toolname; ?> <span class='sr-only'>(current)</span></a></li>"
        ?>
        <?php $additionalNavItemsRight = ""; ?>
        <?php include $templatedir."navbar.phtml"; ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-sm-12">
                    <?php include $templatedir."toolnav.phtml"; ?>
                    <div class="card text-white bg-success" style="margin-top:15px;">
                        <div class="card-header collapsed" type="button" data-toggle="collapse" data-target="#infoCollapse" aria-expanded="false" aria-controls="infoCollapse">INFO ( Click me! )</div>
                        <div class="card-body collapse" id="infoCollapse">
                            This Tool is currently WIP!
                            <h3>SpaceEngineers Component Calculator</h3>
                            <p>
                                This tool allows you to calculate all the components and raw resources you will need for your build.<br/>
                                Just add the blocks you need and watch as the tool calculates what components you will need.<br/>
                                Feedback welcome!
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-sm-12">
                    <div class="row" style="margin-bottom:15px;">
                        <div class="col-sm-12 col-md-6">
                            <div class="card text-white bg-dark">
                                <div class="card-header">Add Blocks</div>
                                <div class="card-body">
                                    <p>
                                        Select a Part from the List below and click the "Add" Button to add it to the list.
                                    </p>
                                    <div class="row">
                                        <div class="col-md-6">
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
                                        <div class="col-md-2">
                                            <select id="partpicker-gridsize" name="gridsize" class="gridsize-selector form-control">
                                                <option value="large">Large</option>
                                                <option value="small">Small</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <input id="partpicker-amount" type="number" value="1" min="1" max="1000" class="form-control"/>
                                        </div>
                                        <div class="col-md-2">
                                            <button class="btn btn-success"><i class="fa fa-lg fa-plus" onclick="addpart()"></i>&nbsp;Add</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="card text-white bg-dark">
                                <div class="card-header">Added Blocks (newest on top)</div>
                                <table class="card-body table table-striped table-condensed table-hover text-light" id="partlist">
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
                    </div>
                    <div class="card text-light bg-secondary">
                        <div class="card-header"><button class="btn btn-primary"><i class="fa fa-sync"></i></button>&nbsp;&nbsp;Parts needed:</div>
                        <div class="card-body">
                            {content}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include $templatedir."head/jsfiles.phtml"; ?>
        <script>
            $(document).ready(function() {
                $('.part-selector').select2();
                $('.gridsize-selector').select2();
            });
            let blocklist = {"large": {}, "small": {}};
            function getnames(namelist = []) {
                $.ajax
                (
                    {
                        type: 'POST',
                        url: 'nameresolv.php',
                        data: dataString,
                        cache: false,
                        beforeSend: function() {},
                        success: function(data) {
                            let success = data.success;
                            if(success) {
                                toastr.success("Got names from resolver!");
                                return data.names;
                            } else {
                                let message = data.message;
                                toastr.error(message);
                            }
                        }
                    }
                )
            }
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
</html>