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
Route::get('preparedness_response/', 'PreparednessResponseController@index');
Route::get('preparedness_response/list', 'PreparednessResponseController@index');
Route::get('preparedness_response/view/{id}', 'PreparednessResponseController@view_report');
Route::get('preparedness_response/download/{file}', 'PreparednessResponseController@filename');
Route::post('preparedness_response/upload', 'PreparednessResponseController@upload');

# configuration
Route::get('configuration/', 'ConfigurationResponseController@index');
Route::get('configuration/list', 'ConfigurationResponseController@index');
Route::get('configuration/new', 'ConfigurationResponseController@add');
Route::post('configuration/store', 'ConfigurationResponseController@store');
Route::get('configuration/view/{id}', 'ConfigurationResponseController@view');
Route::get('configuration/delete/{id}', 'ConfigurationResponseController@delete');
Route::post('configuration/update/{id}', 'ConfigurationResponseController@update');

# reports
Route::get('reports/', 'ReportsController@index');
Route::get('reports/list', 'ReportsController@index');
Route::get('reports/new', 'ReportsController@add');
Route::get('reports/view/{id}', 'ReportsController@view_report');
Route::get('reports/delete/{id}', 'ReportsController@delete');
Route::get('reports/view_datatable/{id}', 'ReportsController@view_datatable');
Route::get('reports/download/{file}', 'ReportsController@filename');
Route::post('reports/upload', 'ReportsController@upload');