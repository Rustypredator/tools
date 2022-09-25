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

    private function validateResults($results)
    {
        Log::debug('Starting validation of results.');
        if (!isset($results['timestamp']) || $results['timestamp'] < 0) {
            Log::error("Result did not contain a Timestamp.");
            return false;
        }
        //validate array:
        $mustContainKeys = ['acc','aid','alt','batt','date','dir','dist','filename','hdop','ischarging','lat','lon','pdop','profile','prov','sat','ser','spd','starttimestamp','timeoffset','timestamp','vdop', 'time'];
        $keyDatatype = [
            'acc' => 'float','aid' => 'string','alt' => 'float','batt' => 'float','date' => 'string',
            'dir' => 'float','dist' => 'float','filename' => 'string','hdop' => 'float','ischarging' => 'bool',
            'lat' => 'float','lon' => 'float','pdop' => 'float','profile' => 'string','prov' => 'string',
            'sat' => 'float','ser' => 'string','spd' => 'float','starttimestamp' => 'int','timeoffset' => 'string',
            'timestamp' => 'int','vdop' => 'float', 'time' => 'string'
        ];
        foreach ($mustContainKeys as $requiredKey) {
            if (!isset($results[$requiredKey])) {
                Log::debug('Assigning default value to missing key \"'.$requiredKey.'\"');
                switch ($keyDatatype[$requiredKey]) {
                    case 'float':
                        $results[$requiredKey] = 0.0;
                        break;
                    case 'int':
                        $results[$requiredKey] = 0;
                        break;
                    case 'bool':
                        $results[$requiredKey] = false;
                        break;
                    case 'string':
                        $results[$requiredKey] = 'undefined';
                        break;
                    default:
                        $results[$requiredKey] = false;
                        break;
                }
            }
        }
        Log::debug('finished validation of results:', $results);
        return $results;
    }

    private function writeToInfluxDB($results)
    {
        if (!$results = $this->validateResults($results)) {
            return false; //failed validation.
        }
        //insert into db
        $url = "https://influxdb.monitoring.steltenkamp.net";
        $token = 'w3QN8Vx68g7-l2mUDwVClGWcAJaumGYLQIesPtxNDtBnTw2T1UGZlAW5MD3opO2M_-f3Bmwb44msNBn5XwvxCg==';
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
                'filename' => (string)$results['filename'],
                'hdop' => (float)$results['hdop'],
                'ischarging' => (bool)$results['ischarging'],
                'lat' => (float)$results['lat'],
                'lon' => (float)$results['lon'],
                'pdop' => (float)$results['pdop'],
                'profile' => (string)$results['profile'],
                'prov' => (string)$results['prov'],
                'sat' => (string)$results['sat'],
                'ser' => (string)$results['ser'],
                'spd' => (float)$results['spd'],
                'time' => (string)$results['time'],
                'starttimestamp' => (int)$results['starttimestamp'],
                'timeoffset' => (string)$results['timeoffset'],
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
