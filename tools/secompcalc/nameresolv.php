<?php
    $partlist_object = json_decode(file_get_contents("parts.json"));

    $data = $_POST;
    if (!$data) {
        echo json_encode(array("success"=>false, "message"=>"There was no Data submitted!"));
    }

    if (!isset($data["ident"]) || empty($data["ident"]) || $data["ident"] === "") {
        echo json_encode(array("success"=>false, "message"=>"There was no ident submitted!"));
    }

    $label = "";
    $ident = $data["ident"];
    $blocks = $partlist_object->blocks;
    foreach ($blocks as $block) {
        if ($block->ident === $ident) {
            $name = $block->label;
            echo json_encode(array("success"=>true, "message"=>"Label for $ident was found.", "name"=>$name));
            return;
        }
    }
    echo json_encode(array("success"=>false, "message"=>"We could not find the label for $ident."));