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
    return redirect('predictions');
});

Route::get('predictions', 'S3Controller@predictionForm');
Route::get('s3/list', 'S3Controller@listFileFromS3');
Route::post('s3/upload', 'S3Controller@uploadFileToS3');
Route::get('s3/delete/{name}', 'S3Controller@deleteFileFromS3');

Route::get('ml', 'MLController@index');

Route::get('generator', 'GeneratorController@index');
Route::post('generator', 'GeneratorController@updateDataset');
