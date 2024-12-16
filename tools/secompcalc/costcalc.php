<?php
$partlist_object = json_decode(file_get_contents("blocks.json"), true);

$data = $_POST;
if (!$data) {
    echo json_encode(array("success"=>false, "message"=>"There was no Data submitted!"));
}

if (!isset($data["list"]) || empty($data["list"]) || $data["list"] === "") {
    echo json_encode(array("success"=>false, "message"=>"There was no list submitted!"));
}

$blocks = json_decode($data["list"], true);

$lblocks = $blocks['large'];
$sblocks = $blocks['small'];

$cost = array();

foreach($lblocks as $lblock) {
    $ident = $lblock['ident'];
    $amount = $lblock['amount'];

    //calculate cost:
    $components = $partlist_object[$ident]['Large']['components'];
    foreach ($components as $componentName => $componentCount) {
        //add to costs:
        if(isset($cost[$componentName]))
            $cost[$componentName] += ($componentCount*$amount);
        elseif (!isset($cost[$componentName]))
            $cost[$componentName] = ($componentCount*$amount);
    }
}

foreach($sblocks as $sblock) {
    $ident = $sblock['ident'];
    $amount = $sblock['amount'];

    //calculate cost:
    $components = $partlist_object[$ident]['Small']['components'];
    foreach ($components as $componentName => $componentCount) {
        //add to costs:
        if(isset($cost[$componentName]))
            $cost[$componentName] += ($componentCount*$amount);
        elseif (!isset($cost[$componentName]))
            $cost[$componentName] = ($componentCount*$amount);
    }
}

echo json_encode(array("success"=>true,"message"=>"Your cost has been calculated!","cost"=>$cost));