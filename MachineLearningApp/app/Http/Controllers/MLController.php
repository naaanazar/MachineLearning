<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Aws\MachineLearning\MachineLearningClient;
use Aws\MachineLearning\Exception\MachineLearningException;

class MLController extends Controller
{
    
    public $bucket = 'ml-datasets-test';
    private $client;

    function __construct() {
       $this->client = $this->connectToML();
    }

    public function index()
    {
        return view('ml.index');
    }

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

    public function listMLData()
    {
        $result['describeDataSources'] = $this->describeDataSources();
        $result['describeMLModels'] = $this->describeMLModels();
        $result['describeEvaluations'] = $this->describeEvaluations();
        $result['describeBatchPredictions'] = $this->describeBatchPredictions();
        
        return view('ml.index',['result' => $result]);
    }


    public function describeDataSources ()
    {

        try {

            $result = $this->client->describeDataSources([
                'SortOrder' => 'asc'
            ]);

        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }

        return $result['Results'];
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

        return $result['Results'];
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

        return $result['Results'];
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

        return $result['Results'];
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


    public function createDataSourceFromS3()
    {
//        $DataSourceId, $DataSourceName, $DataSchema
//        $client = $this->connectToML();
//
//        try {
//           $result = $client->createDataSourceFromS3([
//                'ComputeStatistics' => true,
//                'DataSourceId' => $DataSourceId, // REQUIRED
//                'DataSourceName' => $DataSourceName,
//                'DataSpec' => [ // REQUIRED
//                    'DataLocationS3' => 's3://ml-datasets-test/123.csv', // REQUIRED
//                    'DataRearrangement' => '{"splitting":{"percentBegin":0,"percentEnd":70}}',
//                    'DataSchema' => $DataSchema
//                ],
//            ]);
//
//        } catch (S3Exception $e) {
//            echo $e->getMessage() . "\n";
//        }
        //echo '<pre>';
        //print_r($result);
        //return $result['DataSourceId'];

        return redirect('ml')->with('edit', '<strong>Success!</strong> File successfully uploaded to S3');
    }
}
