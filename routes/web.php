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

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/tools/{tool}/{toolSubsite?}', [App\Http\Controllers\Pub\ToolController::class, 'index']);
Route::post('/tools/{tool}/{toolSubsite?}', [App\Http\Controllers\Pub\ToolController::class, 'index']);
Route::post('/tools/ajax/{tool}', [App\Http\Controllers\Pub\ToolController::class, 'ajaxIndex']);
