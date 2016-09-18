<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('qb_token', function() {
    return view('qb_token');
});

Route::get('qb_token/rt', 'QbController@rt');
Route::get('qb_token/at', 'QbController@at');

Route::get('sdb_login', function() {
    return view('sdb_login');
});