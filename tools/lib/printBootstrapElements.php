<?php

/**
 * directly prints a bootstrap alert.
 *
 * @param string $type type of alert. accepts info,success,warning,danger
 * @param string $message content of alert.
 * @param bool $closebtn true to make alert dismissible otherwise false.
 */
function printBootstrapAlert($type,$message,$closebtn=true) {
    $types = array("success","info","warning","danger");
    if(!in_array($type,$types)){
        $alert = "Warning! The specified type \"$type\" does not exist!";
    } else {
        $typeIcon = "";
        switch($type) {
            case "success":
                $typeIcon = "<span class='glyphicon glyphicon-align-left glyphicon-ok-sign'></span>&nbsp;";
                break;
            case "info":
                $typeIcon = "<span class='glyphicon glyphicon-align-left glyphicon-info-sign'></span>&nbsp;";
                break;
            case "warning":
                $typeIcon = "<span class='glyphicon glyphicon-align-left glyphicon-warning-sign'></span>&nbsp;";
                break;
            case "danger":
                $typeIcon = "<span class='glyphicon glyphicon-align-left glyphicon-exclamation-sign'></span>&nbsp;";
                break;
            case "default":
                break;
        }
        if ($closebtn) {
            $closeButton = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>";
            $alert = "<div class=\"alert alert-$type alert-dismissible\" role=\"alert\">";
            $alert .= $closeButton;
        } else {
            $alert = "<div class=\"alert alert-$type\" role=\"alert\">";
        }
        $alert .= $typeIcon;
        $alert .= $message;
        $alert .= "</div>";
    }
    echo $alert;
}

/**
 * @param string $id defines what id the panel-div will have
 * @param string $type defines type of panel accepts default|primary|info|warning|success|danger
 * @param string $title title of panel
 * @param string $content content of panel
 * @param bool $collapseable
 * @param bool $return
 * @return string|bool false if type is not correct, string if @param $return is true
 */
function printBootstrapPanel($id,$type,$title,$content,$collapseable=false,$expanded=false,$parent="",$return=false) {
    $id = str_replace(" ","_",strtolower($id));
    $parent = str_replace(" ","_",strtolower($parent));
    if(!in_array($type,array("default","primary","success","info","warning","danger")))
        return false;
    if(!$collapseable) {
        $panel = "<div class='panel panel-$type' id='$id'><div class='panel-heading'><h2 class='panel-title'>$title</h2></div><div class='panel-body'>$content</div></div>";
    } else {
        $panel = "<div class='panel panel-$type' id='$id'>"; //start panel
        $panel .= "<div class='panel-heading' role='tab' id='panelHeading_$id' data-toggle='collapse'";
        if($parent !== "")
            $panel .= "data-parent='#$parent' "; //add parent if existent
        $panel .= "href='#collapse$id' aria-expanded='$expanded' aria-controls='collapse$id'>"; //start heading
        $panel .= "<h4 class='panel-title'>$title</h4>"; //add title
        $panel .= "</div>"; //close heading
        $panel .= "<div id='collapse$id' class='panel-collapse collapse' role='tabpanel' aria-labelledby='panelHeading$id'>"; //start collapse
        $panel .= "<div class='panel-body'>$content</div>"; //add body
        $panel .= "</div>"; //close collapse
        $panel .= "</div>"; //close panel
    }
    if($return) {
        return $panel;
    } else {
        echo $panel;
        return true;
    }
}

/**
 * directly prints a Bootstrap label.
 *
 * @param $type string type of label. accepts default,primary,info,success,warning,danger
 * @param $content string content of the label.
 * @param $extraClasses string additional classes for the label
 */
function printBootstrapLabel($type,$content,$extraClasses) {
    $label = "<span class=\"label label-$type $extraClasses\">$content</span>";
    echo $label;
}

/**
 * directly prints a bootstrap badge.
 *
 * @param $content string content of the badge
 */
function printBootstrapBadge($content) {
    $badge = "<span class=\"badge\">$content</span>";
    echo $badge;
}
