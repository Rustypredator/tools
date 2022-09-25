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
                'acc' => (float)$results['acc'] ?? 0.0,
                'aid' => (string)$results['aid'] ?? 'undefined',
                'alt' => (float)$results['alt'] ?? 0.0,
                'batt' => (float)$results['batt'] ?? 0.0,
                'date' => $results['date'] ?? 'undefined',
                'dir' => (float)$results['dir'] ?? 0.0,
                'dist' => (float)$results['dist'] ?? 0.0,
                'filename' => (string)$results['filename'] ?? 'undefined',
                'hdop' => (float)$results['hdop'] ?? 0.0,
                'ischarging' => (bool)$results['ischarging'] ?? false,
                'lat' => (float)$results['lat'] ?? 0.0,
                'lon' => (float)$results['lon'] ?? 0.0,
                'pdop' => (float)$results['pdop'] ?? 0.0,
                'profile' => (string)$results['profile'] ?? 'undefined',
                'prov' => (string)$results['prov'] ?? 'undefined',
                'sat' => (string)$results['sat'] ?? 'undefined',
                'ser' => (string)$results['ser'] ?? 'undefined',
                'spd' => (float)$results['spd'] ?? 0.0,
                'starttimestamp' => (int)$results['starttimestamp'] ?? 0,
                'timeoffset' => (string)$results['timeoffset'] ?? 'undefined',
                'timestamp' => (int)$results['timestamp'] ?? 0,
                'vdop' => (float)$results['vdop'] ?? 0.0,
            ],
            'time' => $results['timestamp']
        ];
        Log::Debug('Writing to influxDB API: ', $dataArray);
        $writeApi->write($dataArray);
        $writeApi->close();
    }
}
