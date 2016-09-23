<?php

Route::get('/', 'FirstPageController@firstPage');

Route::get('prediction', 'PredictionController@doView');
Route::post('prediction/predict', 'PredictionController@doPredict');

Route::get('/s3/download-from-s3/', 'S3Controller@downloadFromS3');
Route::get('/s3/file-exists/', 'S3Controller@fileExists');

Route::get('ml', 'MLController@index');

Route::get('/ml/describe-data-sources', 'MLController@listDataSources');
Route::get('/ml/describe-ml-model', 'MLController@listMLModels');
Route::get('/ml/describe-evaluations', 'MLController@listEvaluations');
Route::get('/ml/describe-batch-prediction', 'MLController@listBatchPredictions');

Route::post('ml/create-datasource', 'MLController@createDataSourceFromS3');
Route::post('ml/create-ml-model', 'MLController@createMLModel');
Route::post('ml/create-evaluation', 'MLController@createEvaluation');

Route::post('/ml/upload-batch-source', 'MLController@createBatchPrediction');
Route::get('/ml/status-batch-data-source/{DataSourceId}', 'MLController@statusDataSource');

Route::get('/ml/delete-datasource/{id}', 'MLController@deleteDataSource');
Route::get('/ml/delete-ml-model/{id}', 'MLController@deleteMLModel');
Route::get('/ml/delete-evaluation/{id}', 'MLController@deleteEvaluation');
Route::get('/ml/delete-batch-prediction/{id}', 'MLController@deleteBatchPrediction');
Route::post('/ml/delete-endpoint', 'MLController@deleteRealtimeEndpoint');

//ML info
Route::get('/ml/getdatasource/{DataSourceId}', 'MLController@getDataSource');
Route::get('/ml/getmlmodel/{ModelId}', 'MLController@getMLModel');
Route::get('/ml/getevaluation/{EvaluationId}', 'MLController@getEvaluation');
Route::get('/ml/getbatchprediction/{getBatchPredictionId}', 'MLController@getBatchPrediction');
Route::get('/ml/select-S3objects', 'MLController@selectObjectsS3');
Route::get('/ml/select-data-source', 'MLController@selectDataSources');
Route::get('/ml/select-ml-model', 'MLController@selectMLModel');

//Generator
Route::get('generator', 'GeneratorController@index');
Route::post('generate', 'GeneratorController@generateDataset');

//S3
Route::get('s3/allbuckets', 'S3Controller@bucketStruct');
Route::get('s3/delete/{name_bucket}', 'S3Controller@doDeleteBucket');
Route::get('s3/delete_all/{name_bucket}', 'S3Controller@doDeleteAllObjectsFromBucket');
Route::get('s3', 'S3Controller@doIndex');
Route::get('s3', 'S3Controller@doListOfBuckets');
Route::post('s3/create_bucket', 'S3Controller@doCreateBucket');

Route::post('/s3/upload', 'S3Controller@doUpload');
Route::get('/s3/delete/{name}', 'S3Controller@doDelete');
