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


Route::get('/products/{product}/edit', 'ProductController@edit');
Route::patch('/products/save_edit', 'ProductController@saveEdit');


Route::get('/products/add_new', 'ProductController@addNew');


Route::post('/products/{product}/notes', 'NotesController@store');


Route::delete('/products/{productId}/delete', 'ProductController@delete')->where('product', '[0-9]+');

Route::get('/products/{productId}/restore', 'ProductController@restore')->where('product', '[0-9]+');














