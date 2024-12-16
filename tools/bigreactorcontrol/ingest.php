<?php

$data = $_POST;

//read data:
$secret = $data['secret'];
$reactorStatus = json_decode($data['reactorStatus']);

//write dbg log:
$date = date('Ymd');
$f = fopen('logs/'.$secret.'/'.$date.'.log', 'a+');
fwrite($f, json_encode($data)."\n");
fclose($f);

//respond with desired variables:
$crIndexes = [];
for ($i = 0; $i < $reactorStatus['numControlRods']; $i++) {
    $crIndexes[$i] = null;
}
$res = ['active' => null, 'controlRods' => ['all' => null, 'indexes' => $crIndexes], 'ejectWaste' => null];
//to Json:
$resJson = json_encode($res);
