<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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



Auth::routes();


Route::get('/', 'HomeController@index')->name('home');


/* Routes for Host */
Route::middleware('auth')->prefix('host')->namespace('Host')->name('host.')->group(function () {

    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('apartments', ApartmentController::class)->parameter('apartments', 'apartment:slug');
    Route::resource('messages', MessageController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('sponsors', SponsorController::class);
    Route::resource('views', ViewController::class);
});
