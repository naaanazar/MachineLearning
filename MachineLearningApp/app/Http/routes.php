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

Route::get('ml', 'MLController@index');
Route::get('ml', 'MLController@listMLData');
Route::post('ml/create-datasource', 'MLController@createDataSourceFromS3');
Route::post('ml/create-ml-model', 'MLController@createMLModel');
Route::post('ml/create-evaluation', 'MLController@createEvaluation');
Route::post('ml/create-batch-prediction', 'MLController@createBatchPrediction');

Route::get('/ml/delete-datasource/{id}', 'MLController@deleteDataSource');
Route::get('/ml/delete-ml-model/{id}', 'MLController@deleteMLModel');
Route::get('/ml/delete-evaluation/{id}', 'MLController@deleteEvaluation');
Route::get('/ml/delete-batch-prediction/{id}', 'MLController@deleteBatchPrediction');

Route::get('generator', 'GeneratorController@index');
Route::post('generate', 'GeneratorController@generateDataset');

//S3
Route::get('s3/allbuckets', 'S3Controller@bucketStruct');
Route::get('s3/delete/{name_bucket}', 'S3Controller@doDeleteBucket');
Route::get('s3/delete_all/{name_bucket}', 'S3Controller@doDeleteAllObjectsFromBucket');
Route::get('s3', 'S3Controller@doIndex');
Route::get('s3', 'S3Controller@doListOfBuckets');
Route::post('s3/create_bucket', 'S3Controller@doCreateBucket');

Route::get('predictions', 'S3Controller@doPredictionForm');

Route::post('/s3/upload', 'S3Controller@doUpload');
Route::get('/s3/delete/{name}', 'S3Controller@doDelete');


