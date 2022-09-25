<?php

namespace App\Http\Controllers\Api\Tools;

use App\Http\Controllers\Api\ToolsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use InfluxDB2\Client;
use InfluxDB2\Model\WritePrecision;
use InfluxDB2\WriteType;

class GpslogController extends ToolsController
{
    public function index(Request $request, $action = null, $params = null)
    {
        if (is_null($action) || empty($action) || $action == '') {
            return response()->json(['tool' => 'GPS Log', 'short' => 'gpslog', 'description' => 'it logs GPS Coordinates to a database.', 'version' => '0.0.1']);
        } else {
            switch ($action) {
                case 'ingest':
                    $this->ingest();
            }
        }
    }

    private function ingest()
    {
        $body = request()->getContent();
        $pairs = explode('&', $body);
        $results = [];
        foreach ($pairs as $pair) {
            $parts = explode('=', $pair);
            if (!empty($parts) || $parts != "") {
                if (!empty($parts[0]) && !empty($parts[1]) && $parts[0] != "" && $parts[1] != "") {
                    Log::debug("-> ".$parts[0].": ".$parts[1]);
                    $results[$parts[0]] = $parts[1];
                }
            }
        }
        Log::debug('Parsed Data:', [$results]);
        $this->writeToInfluxDB($results);
    }

    private function writeToInfluxDB($results)
    {
        $token = '3gMtFZqh8eXSA_oTOi6pWpMSGR_FHD5aQR-LNVCD8uTp0MbeY8L8PC_wDb-aBjU4_31J_HubMiwHEzx_vEoEog==';
        $org = 'SKMPNT';
        $bucket = "rustytools_gpslog";

        $client = new Client([
            "url" => "https://influxdb.monitoring.steltenkamp.net",
            "token" => $token,
            "verifySSL" => false,
            "tags" => [
                'aid' => $results['aid'],
                'src' => request()->ip(),
                'version' => request()->header('user-agent', 'unknown'),
            ],
            "bucket" => $bucket,
            "org" => $org,
            "precision" => WritePrecision::S
        ]);
        $writeApi = $client->createWriteApi([
            "writeType" => WriteType::BATCHING,
            "batchSize" => 1000
        ]);

        //entry:
        $dataArray = [
            'aid' => $results['aid'],
            'fields' => $results,
            'time' => microtime(true)
        ];
        $writeApi->write($dataArray);
    }
}
