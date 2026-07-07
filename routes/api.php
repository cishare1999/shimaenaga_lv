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

Route::get('kanriapi/{kana}/{birthday}', 'KanriAPIController@index');//center list
Route::get('kanriapishow/{id}', 'KanriAPIController@show');//center ditail
Route::get('kanriapioudan/{kana}/{birthday}', 'KanriAPIController@oudan');//other shop data
Route::get('kanriapitotal/{st}/{fn}', 'KanriAPIController@total');//other shop data
