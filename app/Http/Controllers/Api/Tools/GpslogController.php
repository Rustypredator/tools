
<?php

namespace App\Http\Controllers\Api\Tools;

use App\Http\Controllers\Api\ToolsController;
use Illuminate\Http\Request;

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
        $data = request()->all();
        Log::debug("data:", [$data]);
    }
}
