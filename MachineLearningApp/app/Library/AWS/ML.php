<?php

namespace App\Library\AWS;

use Aws\MachineLearning\MachineLearningClient;
use Aws\MachineLearning\Exception\MachineLearningException;

class ML
{
    public $bucket = 'ml-datasets-test';

    private function connectToML()
    {
        $ml = new MachineLearningClient([
            'version'     => 'latest',
            'region'      => 'us-east-1',
            'credentials' => [
                'key'    => 'AKIAI5RJSS2CYUZ6STHQ',
                'secret' => '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'
            ]
        ]);

        return $ml;
    }


    public function describeDataSources ()
    {

        $client = $this->connectToML();

        try {

            $result = $client->describeDataSources([
                'SortOrder' => 'asc'
            ]);

        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }
        echo '<pre>';
        print_r($result);
    }


    public function describeMLModels ()
    {

        $client = $this->connectToML();

        try {
            $result = $client->describeMLModels([
                'SortOrder' => 'asc'
            ]);

        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }
        echo '<pre>';
        print_r($result);
    }


    public function describeBatchPredictions()
    {

        $client = $this->connectToML();

        try {
            $result = $client->describeBatchPredictions([
                'SortOrder' => 'asc'
            ]);


        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }
        echo '<pre>';
        print_r($result);
    }

    public function describeEvaluations()
    {

        $client = $this->connectToML();

        try {
           $result = $client->describeEvaluations([
                'SortOrder' => 'asc'
            ]);

        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }
        echo '<pre>';
        print_r($result);
    }


    public function getDataSource($DataSourceId)
    {

        $client = $this->connectToML();

        try {

            $result = $client->getDataSource([
                'DataSourceId' => $DataSourceId, // REQUIRED
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
            'MLModelId' => $ModelId, // REQUIRED
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
                'EvaluationId' => $EvaluationId, // REQUIRED
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
                'BatchPredictionId' => $getBatchPredictionId, // REQUIRED
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


    /*
    add:
    [Status] => INPROGRESS
    [Message] => Current Step: BASIC_STATISTICS (1/2) 0%
    */
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


    public function createRealtimeEndpoint($MLModelId)
    {

        $client = $this->connectToML();

        try {
            $result = $client->createRealtimeEndpoint([
                'MLModelId' => $MLModelId, // REQUIRED
            ]);

        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }
        echo '<pre>';
        print_r($result);

    }


    public function predict($MLModelId)
    {

        $client = $this->connectToML();

        try {
           $result = $client->predict([
            'MLModelId' => $MLModelId, // REQUIRED
            'PredictEndpoint' => 'https://realtime.machinelearning.us-east-1.amazonaws.com', // REQUIRED
            'Record' => [
                "email_custom_domain"=>"0",
                "same_email_domain_count"=>"956",
                "projects_count"=>"67",
                "strings_count"=>"46",
                "members_count"=>"843",
                "has_private_project"=>"1",
                "same_login_and_project_name"=>"1",
                "days_after_last_login"=>"8",
                "country"=>"China"]
            ]);


        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }
        echo '<pre>';
        print_r($result);

    }

}