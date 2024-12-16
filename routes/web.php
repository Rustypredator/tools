<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('themes.default.pub.welcome');
});

Auth::routes();

//Dynamic Tools Routes:
Route::get('/tools/{tool}', function($tool) {
    if (view()->exists('themes.default.pub.tools.'.$tool)) {
        return view('themes.default.pub.tools.'.$tool);
    } else {
        return view('themes.default.errors.404');
    }
});
