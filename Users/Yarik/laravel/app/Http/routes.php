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
Route::get('/parsercrawler', 'ParserControllerCrawler@index');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/product', 'ProductController@index'); //complite
Route::get('/product/{product}', 'ProductController@show'); //complite
Route::get('/product/{product}/edit', 'ProductController@edit'); //complite



Route::get('/product/add','ProductController@addProduct');
Route::get('/product/save','ProductController@saveProduct');

//Route::get('/product/{product}', function($product) {
//    return Controller::call('ProductController@product');
//})->where('product', '[0-9]+');

//Route::group(['middleware' => 'web'], function () {
//    Route::post('/product/save', 'ProductController@saveProduct');
//});


//Route::get('/product/{product_id}', 'ProductController@display');
