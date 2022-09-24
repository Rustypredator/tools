<?php

namespace App\Http\Controllers\Api\Tools;

use App\Http\Controllers\Api\ToolsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
            $results[$parts[0]] = $parts[1];
        }
        Log::debug('Parsed Data:', [$results]);
    }
}
