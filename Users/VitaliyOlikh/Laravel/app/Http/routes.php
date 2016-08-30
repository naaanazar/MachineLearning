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
Route::group(['middleware' => ['web']], function () {
    Route::get('parse', 'ParserController@index');
    Route::get('products', 'HomeController@display');
    Route::get('products/add', 'HomeController@add');
    Route::get('products/{productId}/edit', 'HomeController@edit');
    Route::post('update/{productId}', 'HomeController@update');
    Route::post('upload', 'HomeController@upload');
    Route::get('products/{products}', 'HomeController@showOneProduct');
    Route::post('products/delete/{productId}', 'HomeController@delete')->where(['productId' => '[0-9]+']);
});