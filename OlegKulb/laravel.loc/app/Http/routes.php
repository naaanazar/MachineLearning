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

Route::get('/parser', [
    'as' => 'parser', 'uses' => 'Parser@parser'
]);

Route::get('/parser/set', [
    'as' => 'getProducts', 'uses' => 'Parser@setProducts'
]);

Route::get('/products', [
    'as' => 'products', 'uses' => 'HomeController@display'
]);

Route::get('/showProduct/{product}', [
    'as' => 'showProduct', 'uses' => 'ProductsController@showProduct'
])->where('product', '[0-9]+');

Route::get('/products/add', [
    'as' => 'showProduct', 'uses' => 'ProductsController@addProduct'
]);

Route::post('/products/save', [
    'as' => 'showProduct', 'uses' => 'ProductsController@saveProduct'
]);

Route::get('/products/edit/{product}', [
   'as' => 'editProduct', 'uses' => 'ProductsController@editProduct'
]);

Route::post('/products/saveEdit', [
    'as' => 'showProduct', 'uses' => 'ProductsController@saveEditProduct'
]);

Route::post('/products/delete/{product}', [
   'as' => 'editProduct', 'uses' => 'ProductsController@deleteProduct'
]);
