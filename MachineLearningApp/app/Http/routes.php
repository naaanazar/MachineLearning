<?php

Route::get('/', 'FirstPageController@firstPage');

Route::get('prediction', 'PredictionController@doView');
Route::post('prediction/predict', 'PredictionController@doPredict');

Route::get('/s3/download-from-s3/', 'S3Controller@doDownloadFromS3');
Route::get('/s3/file-exists/', 'S3Controller@doFileExists');

Route::get('ml', 'MLController@index');

Route::get('/ml/describe-data-sources', 'MLController@doListDataSources');
Route::get('/ml/describe-ml-model', 'MLController@doListMLModels');
Route::get('/ml/describe-evaluations', 'MLController@doListEvaluations');
Route::get('/ml/describe-batch-prediction', 'MLController@doListBatchPredictions');

Route::post('ml/create-datasource', 'MLController@doCreateDataSourceFromS3');
Route::post('ml/create-ml-model', 'MLController@doCreateMLModel');
Route::post('ml/create-evaluation', 'MLController@doCreateEvaluation');
Route::post('ml/create-main-ml-model', 'MLController@doCreateMainMLModel');

Route::post('/ml/upload-batch-source', 'MLController@doCreateBatchPrediction');

Route::get('/ml/delete-datasource/{id}', 'MLController@doDeleteDataSource');
Route::get('/ml/delete-ml-model/{id}', 'MLController@doDeleteMLModel');
Route::get('/ml/delete-evaluation/{id}', 'MLController@doDeleteEvaluation');
Route::get('/ml/delete-batch-prediction/{id}', 'MLController@doDeleteBatchPrediction');
Route::post('/ml/delete-endpoint', 'MLController@doDeleteRealtimeEndpoint');

//ML info
Route::get('/ml/getdatasource/{DataSourceId}', 'MLController@doGetDataSource');
Route::get('/ml/getmlmodel/{ModelId}', 'MLController@doGetMLModel');
Route::get('/ml/getevaluation/{EvaluationId}', 'MLController@doGetEvaluation');
Route::get('/ml/getbatchprediction/{getBatchPredictionId}', 'MLController@doGetBatchPrediction');

Route::get('/ml/select-S3objects/{bucket}', 'MLController@doSelectObjectsS3');
Route::get('/ml/select-data-source', 'MLController@doSelectDataSources');
Route::get('/ml/select-ml-model', 'MLController@doSelectMLModel');

//Generator
Route::get('generator', 'GeneratorController@doIndex');
Route::post('generate', 'GeneratorController@doGenerateDataset');

//S3
Route::get('s3/allbuckets', 'S3Controller@doBucketStruct');
Route::post('s3/delete/{name_bucket}', 'S3Controller@doDeleteBucket');
Route::get('s3/delete_all/{name_bucket}', 'S3Controller@doDeleteAllObjectsFromBucket');
Route::get('s3', 'S3Controller@doIndex');
Route::get('s3', 'S3Controller@doS3');
Route::post('s3/create_bucket', 'S3Controller@doCreateBucket');

Route::post('/s3/upload', 'S3Controller@doUpload');
Route::post('/s3/delete', 'S3Controller@doDelete');
Route::get('/s3/get-buckets', 'S3Controller@doGetBuckets');

