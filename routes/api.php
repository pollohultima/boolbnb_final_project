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

Route::get('apartments/sponsored', 'API\ApartmentController@sponsored');
Route::get('apartments', 'API\ApartmentController@index');
Route::get('apartments/{apartment}', 'API\ApartmentController@show');
Route::get('advanced_search', 'API\ApartmentController@advanced_search');
Route::get('services', 'API\ServiceController@index');

Route::resource('messages', 'API\MessageController');