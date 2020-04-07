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

Route::apiResource('users', 'UserController');
Route::apiResource('tokens', 'ApiTokenController');

Route::group(['middleware' => 'cors'], function() {
	Route::get('nearust', 'UstadzController@getNearestUstadz');
	Route::resource('orders', 'OrderController');
	Route::resource('users', 'OrUserController');
	Route::post('login', 'UserController@login');
});
