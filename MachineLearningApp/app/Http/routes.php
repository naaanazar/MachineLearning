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

//ML
Route::get('ml', 'MLController@index');

Route::get('/ml/describe-data-sources', 'MLController@listDataSources');
Route::get('/ml/describe-ml-model', 'MLController@listMLModels');
Route::get('/ml/describe-evaluations', 'MLController@listEvaluations');
Route::get('/ml/describe-batch-prediction', 'MLController@listBatchPredictions');

Route::post('ml/create-datasource', 'MLController@createDataSourceFromS3');
Route::post('ml/create-ml-model', 'MLController@createMLModel');
Route::post('ml/create-evaluation', 'MLController@createEvaluation');
Route::post('ml/create-batch-prediction', 'MLController@createBatchPrediction');
Route::post('ml/real-time-prediction', 'MLController@predict');

Route::get('/ml/delete-datasource/{id}', 'MLController@deleteDataSource');
Route::get('/ml/delete-ml-model/{id}', 'MLController@deleteMLModel');
Route::get('/ml/delete-evaluation/{id}', 'MLController@deleteEvaluation');
Route::get('/ml/delete-batch-prediction/{id}', 'MLController@deleteBatchPrediction');

//ML info
Route::get('/ml/getdatasource/{DataSourceId}', 'MLController@getDataSource');
Route::get('/ml/getmlmodel/{ModelId}', 'MLController@getMLModel');
Route::get('/ml/getevaluation/{EvaluationId}', 'MLController@getEvaluation');
Route::get('/ml/getbatchprediction/{getBatchPredictionId}', 'MLController@getBatchPrediction');


//Generator
Route::get('/ml/select-S3objects', 'MLController@selectObjectsS3');
Route::get('/ml/select-data-source', 'MLController@selectDataSources');
Route::get('/ml/select-ml-model', 'MLController@selectMLModel');


Route::get('generator', 'GeneratorController@index');
Route::post('generate', 'GeneratorController@generateDataset');

//Buckets
Route::get('bucket/delete/{name_bucket}', 'BucketController@deleteBucket');
Route::get('bucket/delete_all/{name_bucket}', 'BucketController@deleteAllObjectsFromBucket');
Route::get('bucket', 'BucketController@index');
Route::get('bucket', 'BucketController@listOfBuckets');
Route::post('bucket/create_bucket', 'BucketController@createBucket');

//Update
Route::get('/ml/datasource/{DataSourceId}/update', 'MLController@updateDataSource');
Route::get('/ml/mlmodel/{ModelId}/update', 'MLController@updateMLModel');
Route::get('/ml/evaluation/{EvaluationId}/update', 'MLController@updateEvaluation');
Route::get('/ml/batchprediction/{getBatchPredictionId}/update', 'MLController@updateBatchPrediction');
