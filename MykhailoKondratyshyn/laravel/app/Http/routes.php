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
Route::get('/products/{product}', 'ProductController@show')->where('product', '[0-9]+');
Route::post('/products/save', 'ProductController@save');

Route::get('/add_new', 'ProductController@addNew');



Route::post('/products/{product}/notes', 'NotesController@store');



Route::post('/products/delete/{id}', 'ProductController@deleteProduct');







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

