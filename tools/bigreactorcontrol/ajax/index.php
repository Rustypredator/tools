<?php
	if(isset($_SERVER['HTTP_X_REAL_IP']) && !empty($_SERVER['HTTP_X_REAL_IP'])) {
		$ip = $_SERVER['HTTP_X_REAL_IP'];
	} elseif(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	$date = date("Ymd-His");
	$f = fopen("reqs/$ip-$date.txt", "w");
	fwrite($f, print_r($_SERVER, true)."\n".print_r($_GET, true)."\n".print_r($_POST, true));
	fclose($f);
?>