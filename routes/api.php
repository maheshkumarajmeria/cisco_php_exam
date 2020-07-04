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

Route::get('router/add','APIRouteController@addroute');
Route::get('router/update','APIRouteController@updateroute');
Route::get('router/list','APIRouteController@list');
Route::get('router/listasperiprange','APIRouteController@listasperiprange');
Route::get('router/delete','APIRouteController@delete');
