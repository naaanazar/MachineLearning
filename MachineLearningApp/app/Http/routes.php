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
<<<<<<< HEAD
Route::get('s3/list', 'S3Controller@listFileFromS3');
Route::post('s3/upload', 'S3Controller@uploadFileToS3');
Route::get('s3/delete/{name}', 'S3Controller@deleteFileFromS3');
Route::get('buckets/delete/{name_backet}', 'S3Controller@deleteBucket');


Route::get('buckets/delete_all', 'S3Controller@deleteAllObjectsFromBucket');



Route::get('s3/list_of_buckets', 'S3Controller@listOfBuckets');
Route::get('s3/create_bucket', 'S3Controller@createBucket');
=======
Route::get('s3/list/', 'S3Controller@listS3');
Route::post('s3/upload', 'S3Controller@upload');
Route::get('s3/delete/{name}', 'S3Controller@delete');
>>>>>>> master

Route::get('ml', 'MLController@index');

Route::get('generator', 'GeneratorController@index');
Route::post('generator', 'GeneratorController@updateDataset');
<<<<<<< HEAD


//Buckets
Route::get('bucket/delete/{name_bucket}', 'BucketController@deleteBucket');
Route::get('bucket/delete_all/{name_bucket}', 'BucketController@deleteAllObjectsFromBucket');
Route::get('bucket', 'BucketController@index');
Route::get('bucket', 'BucketController@listOfBuckets');
Route::post('bucket/create_bucket', 'BucketController@createBucket');
=======
>>>>>>> master
