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

Route::get('/', 'WelcomeController@index');
Route::get('/dvds/search', 'DvdController@search');
Route::get('/dvds/results', 'DvdController@results');
Route::get('/dvds/create', 'DvdController@createDvd');
Route::post('/dvds/insert', 'DvdController@insert');
Route::get('/genres/{genreName}/dvds', 'DvdController@genre');
Route::get('/dvds/{id}','DvdController@review');