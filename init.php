<?php
//config
$template = "default";
$basedir = $_SERVER['DOCUMENT_ROOT'].'/';
if ($_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' || $_SERVER['HTTPS'] == 'on') {
    $scheme = 'https';
} else {
    $scheme = 'http';
}
$baseurl = $scheme.'://'.$_SERVER['HTTP_HOST'].'/';
$toolsurl = $baseurl."tools/";
$toolsdir = $basedir."tools/";
$templateurl = $baseurl."templates/".$template."/";
$templatedir = $basedir."templates/".$template."/";
$assetsurl = $templateurl."assets/";
