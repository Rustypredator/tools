<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::any('/', [App\Http\Controllers\ApiController::class, 'info']);

//Dynamic Tools Routes:
Route::get('/tools/{tool}/{action?}/{params?}', function($tool, $action = '', $params = '') {
    $app = app();
    $controller = $app->make('\App\Http\Controllers\Api\Tools\\'.ucfirst($tool).'Controller');
    return $controller->callAction('index', [$action, $params]);
});
