<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

# site pages
Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index');

# preparedness response
Route::get('preparedness_response/new', 'PreparednessResponseController@add');
Route::post('preparedness_response/upload', 'PreparednessResponseController@upload');