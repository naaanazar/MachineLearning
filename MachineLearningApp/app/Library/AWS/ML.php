<?php

namespace App\Library\AWS;

use Aws\MachineLearning\MachineLearningClient;
use Aws\MachineLearning\Exception\MachineLearningException;

class ML
{
   private $bucket = 'ml-datasets-test';
   private $client;

    public function __construct()
    {
        $this->client = $this->connectToML();
    }


    private function connectToML()
    {
        $ml = new MachineLearningClient([
            'version' => 'latest',
            'region' => 'us-east-1',
            'credentials' => [
                'key' => 'AKIAI5RJSS2CYUZ6STHQ',
                'secret' => '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'
            ]
        ]);
        return $ml;
    }

     public function describeDataSources()
    {
        try {
            $result = $this->client->describeDataSources([
            ]);
        } catch (MachineLearningException $e) {
            echo $e->getMessage() . "\n";
        }

        return $result['Results'];
    }

    public function describeMLModels()
    {

        try {
            $result = $this->client->describeMLModels([
                'SortOrder' => 'asc'
            ]);

        } catch (MachineLearningException $e) {
            echo $e->getMessage() . "\n";
        }

        return $result['Results'];
    }


    public function describeEvaluations()
    {

        try {
            $result = $this->client->describeEvaluations([
                'SortOrder' => 'asc'
            ]);

        } catch (MachineLearningException $e) {
            echo $e->getMessage() . "\n";
        }

        return $result['Results'];
    }


    public function describeBatchPredictions()
    {

        try {
            $result = $this->client->describeBatchPredictions([
                'SortOrder' => 'asc'
            ]);


        } catch (MachineLearningException $e) {
            echo $e->getMessage() . "\n";
        }

        return $result['Results'];
    }


    public function statusDataSource($DataSourceId)
    {
        try {
            $result = $this->client->getDataSource([
                'DataSourceId' => $DataSourceId,
                'Verbose' => true || false,
            ]);

        } catch (MachineLearningException $e) {
            echo $e->getMessage() . "\n";
        }
        return response()->json(['data' => $result['Status']]);
    }

    public function statusBatch($BatchPredictionId)
    {
        try {
            $result = $this->client->getBatchPrediction([
                'BatchPredictionId' => $BatchPredictionId,
                'Verbose' => true || false,
            ]);

        } catch (MachineLearningException $e) {
            echo $e->getMessage() . "\n";
        }
        dd($result);
        return $result;
    }

    public function updateDataSource(Request $request)
    {

        $DataSourceId = $request->id;
        $DataSourceName = $request->name;

        try {
            $result = $this->client->updateDataSource([
                'DataSourceId' => $DataSourceId,
                'DataSourceName' => '$DataSourceName',
            ]);

        } catch (MachineLearningException $e) {
            return response()->json(['data' => $e->getMessage()]);
        }

         return response()->json(['data' => $DataSourceId . $DataSourceName]);
    }

    public function updateMLModel($ModelId)
    {
        try {
            $result = $this->client->updateMLModel([
                'MLModelId' => $ModelId,
            ]);

        } catch (MachineLearningException $e) {
            echo $e->getMessage() . "\n";
        }
    }

    public function updateEvaluation($EvaluationId)
    {

        try {
            $result = $this->client->getEvaluation([
                'EvaluationId' => $EvaluationId,
            ]);

            $this->client->updateEvaluation([
                'EvaluationId' => $result['EvaluationId'],
                'EvaluationName' => $result['Name'],
            ]);


        } catch (MachineLearningException $e) {
            echo $e->getMessage() . "\n";
        }
    }

    public function updateBatchPrediction($getBatchPredictionId)
    {
        try {

            $result = $this->client->getBatchPrediction([
                'BatchPredictionId' => $getBatchPredictionId,
            ]);
            dd($result['BatchPredictionId'], $result['Name']);
            $this->client->updateBatchPrediction([
                'BatchPredictionId' => $result['BatchPredictionId'],
                'BatchPredictionName' => $result['Name'],
            ]);
        } catch (MachineLearningException $e) {
            echo $e->getMessage() . "\n";
        }
    }

    public function getDataSource($DataSourceId)
    {

        $client = $this->connectToML();

        try {

            $result = $client->getDataSource([
                'DataSourceId' => $DataSourceId,
                'Verbose' => true || false,
            ]);

        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }
        echo '<pre>';
        print_r($result);
    }

    public function getMLModel($ModelId)
    {

        $client = $this->connectToML();

        try {

            $result = $client->getMLModel([
            'MLModelId' => $ModelId,
            'Verbose' => true,
        ]);

        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }
        echo '<pre>';
        print_r($result);
    }

    public function getEvaluation($EvaluationId)
    {

        $client = $this->connectToML();

        try {

            $result = $client->getEvaluation([
                'EvaluationId' => $EvaluationId,
            ]);

        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }
        echo '<pre>';
        print_r($result);
    }

    public function getBatchPrediction($getBatchPredictionId)
    {

        $client = $this->connectToML();

        try {
           $result = $client->getBatchPrediction([
                'BatchPredictionId' => $getBatchPredictionId,
            ]);

        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }
        echo '<pre>';
        print_r($result);
    }

    public function createDataSourceFromS3($DataSourceId, $DataSourceName, $DataSchema)
    {

        $client = $this->connectToML();

        try {
           $result = $client->createDataSourceFromS3([
                'ComputeStatistics' => true,
                'DataSourceId' => $DataSourceId, // REQUIRED
                'DataSourceName' => $DataSourceName,
                'DataSpec' => [ // REQUIRED
                    'DataLocationS3' => 's3://ml-datasets-test/123.csv', // REQUIRED
                    'DataRearrangement' => '{"splitting":{"percentBegin":0,"percentEnd":70}}',
                    'DataSchema' => $DataSchema
                ],
            ]);

        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }
        echo '<pre>';
        print_r($result);
        return $result['DataSourceId'];
    }
  
    public function createMLModel($ModelId, $ModelName, $ModelType, $DataSourceId)
    {

        $client = $this->connectToML();

        try {

            $result = $client->createMLModel([
                'MLModelId' => $ModelId, // REQUIRED
                'MLModelName' => $ModelName,
                'MLModelType' => $ModelType, // REQUIRED
                //'Parameters' => ['<string>', ...],
                //'Recipe' => '<string>',
                //'RecipeUri' => '<string>',
                'TrainingDataSourceId' => $DataSourceId, // REQUIRED
            ]);

        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }
        echo '<pre>';
        print_r($result);
        return $result['MLModelId'];
    }

    public function createEvaluation($EvaluationName, $EvaluationId, $ModelId, $EvaluationDataSourceId)
    {

        $client = $this->connectToML();

        try {

            $result = $client->createEvaluation([
                'EvaluationDataSourceId' => $EvaluationDataSourceId, // REQUIRED
                'EvaluationId' => $EvaluationId, // REQUIRED
                'EvaluationName' => $EvaluationName,
                'MLModelId' => $ModelId, // REQUIRED
            ]);

        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }
        echo '<pre>';
        print_r($result);

        return $result['EvaluationId'];
    }

    public function createDataSourceBathFromS3($DataSourceId, $DataSourceName, $DataSchema)
    {

        $client = $this->connectToML();

        try {
           $result = $client->createDataSourceFromS3([
                'ComputeStatistics' => true,
                'DataSourceId' => $DataSourceId, // REQUIRED
                'DataSourceName' => $DataSourceName,
                'DataSpec' => [ // REQUIRED
                    'DataLocationS3' => 's3://ml-datasets-test/123_b.csv', // REQUIRED
                    'DataSchema' => $DataSchema
                ],
            ]);

        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }
        echo '<pre>';
        print_r($result);
        return $result['DataSourceId'];
    }

    public function createBatchPrediction($BatchPredictionDataSourceId, $BatchPredictionId, $BatchPredictionName, $ModelId, $OutputUri)
    {

        $client = $this->connectToML();

        try {
           $result = $client->createBatchPrediction([
                'BatchPredictionDataSourceId' => $BatchPredictionDataSourceId, // REQUIRED
                'BatchPredictionId' => $BatchPredictionId, // REQUIRED
                'BatchPredictionName' => $BatchPredictionName,
                'MLModelId' => $ModelId, // REQUIRED
                'OutputUri' => $OutputUri, // REQUIRED
            ]);

        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }
        echo '<pre>';
        print_r($result);
        return $result['BatchPredictionId'];
    }
    
}