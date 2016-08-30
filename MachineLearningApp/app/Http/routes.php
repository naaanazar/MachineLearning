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
Route::get('/', 'S3Controller@predictionForm');
Route::get('list', 'S3Controller@listFileFromS3');
Route::get('delete/{name}', 'S3Controller@deleteFileFromS3');
<<<<<<< HEAD
Route::get('generator', 'GeneratorController@index');
Route::post('generator', 'GeneratorController@updateDataset');
=======

>>>>>>> 71bb134de6c8a6253ead50db793aac82dd2fa421
