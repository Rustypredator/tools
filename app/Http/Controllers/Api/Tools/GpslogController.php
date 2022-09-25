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
        if (!isset($results['timestamp']) || $results['timestamp'] < 0) {
            return false;
        }
        $url = "https://influxdb.monitoring.steltenkamp.net";
        $token = 'HKLfoiOOHGo8UWMXY8pUfR9hy6l4occ2R8w-pXPSNAtdQi6Xf591434uogv5kgZCu_6FIrGiFFc2bSs4GdfZzA==';
        $org = 'rustyinfo';
        $bucket = "tools_gpslog";

        $client = new Client([
            "url" => $url,
            "token" => $token,
            "verifySSL" => false,
            "tags" => [
                'src' => request()->ip(),
                'version' => request()->header('user-agent', 'unknown'),
            ],
            "bucket" => $bucket,
            "org" => $org,
            "precision" => WritePrecision::S,
            "debug" => true,
        ]);
        $writeApi = $client->createWriteApi();

        //entry:
        $dataArray = [
            'name' => $results['aid'],
            'tags' => [],
            'fields' => [
                'acc' => (float)$results['acc'],
                'aid' => (string)$results['aid'],
                'alt' => (float)$results['alt'],
                'batt' => (float)$results['batt'],
                'date' => $results['date'],
                'dir' => (float)$results['dir'],
                'dist' => (float)$results['dist'],
                'filename' => $results['filename'],
                'hdop' => (float)$results['hdop'],
                'ischarging' => (bool)$results['ischarging'],
                'lat' => (float)$results['lat'],
                'lon' => (float)$results['lon'],
                'pdop' => (float)$results['pdop'],
                'profile' => $results['profile'],
                'prov' => $results['prov'],
                'sat' => $results['sat'],
                'ser' => $results['ser'],
                'spd' => (float)$results['spd'],
                'starttimestamp' => (int)$results['starttimestamp'],
                'timeoffset' => $results['timeoffset'],
                'timestamp' => (int)$results['timestamp'],
                'vdop' => (float)$results['vdop'],
            ],
            'time' => $results['timestamp']
        ];
        Log::Debug('Writing to influxDB API: ', $dataArray);
        $writeApi->write($dataArray);
        $writeApi->close();
    }
}
