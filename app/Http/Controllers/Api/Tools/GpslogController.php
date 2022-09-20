
<?php

namespace App\Http\Controllers\Api\Tools;

use App\Http\Controllers\Api\ToolsController;
use Illuminate\Http\Request;

class GpslogController extends ToolsController
{
    public function ingest()
    {
        $data = request()->all();
        Log::debug("data:", [$data]);
    }
}
