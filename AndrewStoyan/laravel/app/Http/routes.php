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

Route::get('/', function () {
    return view('welcome');
});

Route::get('parse', 'ParserController@index');
Route::get('data', 'MainController@data');
Route::get('products', 'MainController@display');
Route::get('crawler', 'CrawlerController@index');