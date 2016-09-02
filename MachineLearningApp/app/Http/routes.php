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
Route::get('s3/list/', 'S3Controller@listS3');
Route::post('/s3/upload', 'S3Controller@upload');
Route::get('/s3/delete/{name}', 'S3Controller@delete');

Route::get('ml', 'MLController@index');
Route::get('ml', 'MLController@listMLData');
Route::post('ml/datasource', 'MLController@createDataSourceFromS3');
Route::get('/ml/delete-datasource/{id}', 'MLController@deleteDataSource');
Route::get('/ml/delete-ml-model/{id}', 'MLController@deleteMLModel');
Route::get('/ml/delete-evaluation/{id}', 'MLController@deleteEvaluation');
Route::get('/ml/delete-batch-prediction/{id}', 'MLController@deleteDataSource');

Route::get('generator', 'GeneratorController@index');
Route::post('generate', 'GeneratorController@generateDataset');

//Buckets
Route::get('bucket/delete/{name_bucket}', 'BucketController@deleteBucket');
Route::get('bucket/delete_all/{name_bucket}', 'BucketController@deleteAllObjectsFromBucket');
Route::get('bucket', 'BucketController@index');
Route::get('bucket', 'BucketController@listOfBuckets');
Route::post('bucket/create_bucket', 'BucketController@createBucket');
