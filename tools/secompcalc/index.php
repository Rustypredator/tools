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

function convertBlocks($file = "CubeBlocks.sbc", $hashfile = "CubeBlocks.hash") {
    if (!is_file($file)) {
        return false;
    }

    if (!is_file($hashfile))
        $oldhash = null;
    else
        $oldhash = file_get_contents($hashfile);

    //create hash for file:
    $hash = md5_file($file);

    //only continue if file is new
    if ($oldhash === $hash) {
        return true;
    } elseif ($oldhash !== $hash || $oldhash === null) {
        file_put_contents($hashfile, $hash);
    }

    $cubeBlocks = simplexml_load_file($file);
    foreach ($cubeBlocks->CubeBlocks->Definition as $block) {
        //process information:

        //Identifier
        $id = $block->Id->TypeId . "_";
        $subtype = (string)$block->Id->SubtypeId;
        $subtype = str_replace(array("Large", "Small", "Sm", "Lg"), "", $subtype); //remove notations of size from subtype id
        $id .= $subtype;

        //DisplayName
        $displayName = (string)$block->DisplayName;

        //Icon Name
        $iconString = (string)$block->Icon;
        //check if / or \ because keen are retards and mix those...
        if (strpos($iconString, "/"))
            $iconParts = explode("/", (string)$iconString);
        elseif (strpos($iconString, "\\"))
            $iconParts = explode("\\", (string)$block->Icon);
        //construct filename
        $iconFileName = $iconParts[(count($iconParts) - 1)];
        $iconFileParts = explode(".", $iconFileName);
        $icon = reset($iconFileParts);

        //get the publicity, doesnt work...
        $public = (bool)$block->Public;
        //Check if publicly buildable:
        /*if (!$public) {
            echo "$id is not buildable without creative! $public\n";
            continue;
        }*/

        $size = (string)$block->CubeSize;
        $buildTime = (int)$block->BuildTimeSeconds;
        $pcu = (int)$block->PCU;
        //Special treatment here
        $componentInfo = array();
        $components = $block->Components;
        $criticalComponent = $block->CriticalComponent;
        foreach ($components->Component as $component) {
            $type = (string)$component['Subtype'];
            $amount = (int)$component['Count'];
            //check if a component by that name already exists:
            if (isset($componentInfo[$type]))
                $componentInfo[$type] += $amount; //add then
            elseif (!isset($componentInfo[$type]))
                $componentInfo[$type] = $amount; //just set if not
        }
        //Create info array
        $blockInfo = [
            'id' => $id,
            'displayName' => $displayName,
            'icon' => $icon,
            'size' => $size,
            'buildTime' => $buildTime,
            'pcu' => $pcu,
            'components' => $componentInfo,
            'criticalComponent' => ''
        ];
        $blocks[$id][$size] = $blockInfo;
    }
    if (is_file("blocks.json"))
        unlink("blocks.json"); //remove file
    file_put_contents("blocks.json", json_encode($blocks)); //put contents
    return true;
}

$toolname = "SeCompCalc";
$partlist_object = json_decode(file_get_contents("blocks.json"));
$toolshort = strtolower($toolname);
$toolDescShort = "";

//run compiler:
convertBlocks();
?>
<!DOCTYPE html>
<html lang="en">
<?php include $templatedir."head/head.phtml"; ?>
    <body>
        <?php
            $additionalNavItems = "<li class='nav-item'><a class='nav-link' href='".$baseurl."'>Home</a></li>";
            $additionalNavItems .= "<li class='nav-item active'><a class='nav-link' href='".$baseurl.$toolshort."'>$toolname <span class='sr-only'>(current)</span></a></li>"
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
                    <div class="card text-white bg-dark mb-1">
                        <div class="card-header">Add Blocks</div>
                        <div class="card-body">
                            <p>
                                Select a Part from the List below and click the "Add" Button to add it to the list.
                            </p>
                            <div class="row">
                                <div class="col-md-2">Large-Grid:</div>
                                <div class="col-md-6">
                                    <select id="partpicker-part-large" name="part" class="part-selector form-control">
                                        <option value="null">-- Select Part to add --</option>
                                        <?php foreach ($partlist_object as $block): ?>
                                            <?php
                                            if (!isset($block->Large)) {
                                                continue;
                                            }
                                            $id = $block->Large->id;
                                            $displayName = $block->Large->displayName;
                                            ?>
                                            <option value="<?php echo $id; ?>"><?php echo $displayName; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <input id="partpicker-amount-large" type="number" value="1" min="1" max="1000" class="form-control"/>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-success" onclick="addpart('large')"><i class="fa fa-lg fa-plus"></i>&nbsp;Add</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Small-Grid:</div>
                                <div class="col-md-6">
                                    <select id="partpicker-part-small" name="part" class="part-selector form-control">
                                        <option value="null">-- Select Part to add --</option>
                                        <?php foreach ($partlist_object as $block): ?>
                                            <?php
                                            if (!isset($block->Small)) {
                                                continue;
                                            }
                                            $id = $block->Small->id;
                                            $displayName = $block->Small->displayName;
                                            ?>
                                            <option value="<?php echo $id; ?>"><?php echo $displayName; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <input id="partpicker-amount-small" type="number" value="1" min="1" max="1000" class="form-control"/>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-success" onclick="addpart('small')"><i class="fa fa-lg fa-plus"></i>&nbsp;Add</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card text-white bg-dark mb-1">
                        <div class="card-header">Added Blocks</div>
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
                    <div class="card text-light bg-secondary">
                        <div class="card-header"><button class="btn btn-primary" onclick="calculateparts()"><i class="fa fa-sync"></i></button>&nbsp;&nbsp;Parts needed:</div>
                        <table class="table table-striped table-hover table-condensed card-body">
                            <thead>
                                <tr>
                                    <th>Part</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody id="partscost">
                                <tr><td colspan="2">--nothing here yet--</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php include $templatedir."head/jsfiles.phtml"; ?>
        <script>
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
                document.getElementById('partscost').innerHTML = "";
                let costData = "";
                let dataString = "list=" + JSON.stringify(blocklist);
                $.ajax
                (
                    {
                        type: 'POST',
                        url: 'costcalc.php',
                        data: dataString,
                        cache: false,
                        beforeSend: function() {},
                        success: function(data) {
                            obj = JSON.parse(data);
                            let success = obj.success;
                            if(success) {
                                toastr.success(obj.message);
                                costData = obj.cost;
                                for (component in costData) {
                                    count = costData[component];
                                    let row = "<tr><td>" + component + "</td><td>" + count + "</td></tr>";
                                    $('#partscost:last-child').append(row);
                                }
                            } else {
                                let message = obj.message;
                                toastr.error(message);
                            }
                        }
                    }
                );
            }
            function populatetable() {
                //debug
                console.log(blocklist);
                //clear table
                document.getElementById("partlist_tbody").innerHTML = "";
                //cycle blocklist
                for (block in blocklist["small"]) {
                    obj = blocklist["small"][block];
                    let row = "<tr><td>"+obj.ident+"</td><td>"+obj.amount+"</td><td>small</td><td>actions here</td></tr>";
                    $('#partlist_tbody:last-child').append(row);
                }
                for (block in blocklist["large"]) {
                    obj = blocklist["large"][block];
                    let row = "<tr><td>"+obj.ident+"</td><td>"+obj.amount+"</td><td>large</td><td>actions here</td></tr>";
                    $('#partlist_tbody:last-child').append(row);
                }
            }
            function addpart(partsize) {
                let partident = $('#partpicker-part-' + partsize).val();
                let amount = parseInt($('#partpicker-amount-' + partsize).val());
                if (partident in blocklist[partsize]) {
                    //update amount
                    let oldamount = parseInt(blocklist[partsize][partident].amount);
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