<?php

use Illuminate\Http\Request;

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

//Route::apiResource('users', 'UserController');
Route::get('nearust', 'UstadzController@getNearestUstadz');
Route::get('userorders/{id}', 'UserController@getOrders');
Route::apiResource('orders', 'OrderController');
Route::apiResource('users', 'UserController');
Route::apiResource('pakets', 'PaketController');
Route::apiResource('tokens', 'ApiTokenController');
Route::post('login', 'UserController@login');
