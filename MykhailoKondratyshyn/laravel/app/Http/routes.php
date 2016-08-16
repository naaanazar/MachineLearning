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
Route::get('/parse', 'ParserController@index');

Route::get('/parser', 'ParserDomCrawler@index');

Route::get('/products', 'ProductController@index');
Route::get('/products/{products}', 'ProductController@show');








//Route::get('/products/add', 'ProductController@addProduct');
//Route::post('/products/save', 'ProductController@saveProduct');
//
//
//
//
//
//Route::get('/products/{product}', function($product) {
//    return Controller::call('ProductController@product');
//})->where('product', '[0-9]+');
//
//
//Route::group(['middleware' => 'web'], function () {
//    Route::post('/products/save', 'ProductController@saveProduct');
//});











//Route::get('/parserdisplay/{product_id}', 'HomeController@display');

Route::get('/', function () {
    return view('welcome');
});

