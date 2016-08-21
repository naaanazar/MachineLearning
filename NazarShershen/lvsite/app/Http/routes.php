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

Route::get('/parse', 'ParserController@index');
Route::get('/crawler', 'DomCrawlerController@index');

Route::get('/products/{product}', 'HomeController@showProduct')->where('product', '[0-9]+');
Route::get('/products/add', 'HomeController@addProduct');
Route::get('/products', 'HomeController@display');
Route::post('/products/save', 'HomeController@saveProduct');
Route::delete('/products/delete/{product_id}', 'HomeController@deleteProduct')->where('product', '[0-9]+');
Route::post('/products/forcedelete/{product_id}', 'HomeController@forceDeleteProduct')->where('product', '[0-9]+');
Route::post('/products/restore/{product_id}', 'HomeController@restoreProduct')->where('product', '[0-9]+');

