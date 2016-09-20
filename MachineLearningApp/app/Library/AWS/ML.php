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
    
}