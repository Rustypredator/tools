<?php
$ip = "0.0.0.0";

if(isset($_SERVER['CF-Connecting-IP']) && !empty($_SERVER['CF-Connecting-IP'])) {
	$ip = $_SERVER['CF-Connecting-IP']; //cloudflare User
} elseif(isset($_SERVER['HTTP_X_REAL_IP']) && !empty($_SERVER['HTTP_X_REAL_IP'])) {
	$ip = $_SERVER['HTTP_X_REAL_IP'];
} elseif(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
	$ip = $_SERVER['REMOTE_ADDR'];
}

if(isset($_GET['format']) && $_GET['format'] !== "") {
	$format = $_GET['format'];
	$iparr = ['ip' => $ip];
	$ipobj = (object)$iparr;
	if($format == "json") {
		header('Content-Type: application/json');
		echo json_encode($iparr);
	} elseif($format == "xml") {
		/*header('Content-Type: text/xml');
		echo simplexml_import_dom($ipobj);*/
	}
} else {
	echo $ip;
}
?>
