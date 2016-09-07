<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Aws\MachineLearning\MachineLearningClient;
use Aws\MachineLearning\Exception\MachineLearningException;

use App\Http\Controllers\S3Controller;

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

    public function selectObjectsS3()
    {
        $list = new S3Controller;
        $result = $list->ListObjectsS3();
        /*echo '<pre>';
        print_r($result);*/
        return response()->json(['data' => (array)$result]);
    }

    public function selectDataSources()
    {


    }


    public function describeDataSources ()
    {

        try {

            $result = $this->client->describeDataSources([
                'SortOrder' => 'asc'
            ]);

        } catch (MachineLearningException $e) {
            echo $e->getMessage() . "\n";
        }

        return $result['Results'];
    }


    public function describeMLModels ()
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


    public function getDataSource($DataSourceId)
    {
        
        try {

            $result = $this->client->getDataSource([
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

        try {

            $result = $this->client->getMLModel([
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

        try {

            $result = $this->client->getEvaluation([
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

        try {
           $result = $this->client->getBatchPrediction([
                'BatchPredictionId' => $getBatchPredictionId, // REQUIRED
            ]);

        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }
        echo '<pre>';
        print_r($result);

    }


    public function deleteDataSource($DataSourceId)
    {

        try {
            $result = $this->client->deleteDataSource([
                'DataSourceId' => $DataSourceId, // REQUIRED
            ]);

        } catch (MachineLearningException $e) {
            echo $e->getMessage() . "\n";
        }
        return back();
        
    }


    public function deleteEvaluation($EvaluationId)
    {
        
        try {
           $result = $this->client->deleteEvaluation([
                'EvaluationId' => $EvaluationId, // REQUIRED
            ]);

        } catch (MachineLearningException $e) {
            echo $e->getMessage() . "\n";
        }
        return back();

    }


    public function deleteMLModel($MLModelId)
    {
  
        try {
            $result = $this->client->deleteMLModel([
                'MLModelId' => $MLModelId, // REQUIRED
            ]);

        } catch (MachineLearningException $e) {
            echo $e->getMessage() . "\n";
        }
        return back();

    }


    public function deleteBatchPrediction($BatchPredictionId)
    {

        try {
            $result = $this->client->deleteBatchPrediction([
                'BatchPredictionId' => $BatchPredictionId, // REQUIRED
            ]);

        } catch (MachineLearningException $e) {
            echo $e->getMessage() . "\n";
        }
        return back();
    }


    public function createDataSourceFromS3(Request $request)
    {

        $DataSourceId = 'ds-' . uniqid();
        $DataSourceName = $request->input('DataSourceName');
        $DataLocationS3 = 's3://' . $this->bucket . '/' . $request->input('DataLocationS3');
        $DataSchema = $request->input('DataSchema');
        $DataRearrangement = '{"splitting":{"percentBegin":' . $request->input("DataRearrangementBegin")
                . ',"percentEnd":' . $request->input("DataRearrangementEnd") . '}}';

        try {
           $result = $this->client->createDataSourceFromS3([
                'ComputeStatistics' => true,
                'DataSourceId' => $DataSourceId, // REQUIRED
                'DataSourceName' => $DataSourceName,
                'DataSpec' => [ // REQUIRED
                    'DataLocationS3' => $DataLocationS3, // REQUIRED
                    'DataRearrangement' => $DataRearrangement,
                    'DataSchema' => $DataSchema
                ],
            ]);

        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }      
        
        return back();
    }


    public function createMLModel(Request $request)
    {

        $ModelId = 'ml-' . uniqid();
        $ModelName = $request->input('MLModelName');
        $ModelType = $request->input('MLSModelType');
        $DataSourceId = $request->input('DataSourceId');

        try {

            $result = $this->client->createMLModel([
                'MLModelId' => $ModelId,
                'MLModelName' => $ModelName,
                'MLModelType' => $ModelType,
                'TrainingDataSourceId' => $DataSourceId,
            ]);

        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }
        
        return back();
    }


    public function createEvaluation(Request $request)
    {

        $DataSourceId = $request->input('DataSourceId');
        $EvaluationId = 'ev-' . uniqid();
        $EvaluationName = $request->input('EvaluationName');
        $MLModelId = $request->input('MLModelId');

        try {

            $result = $this->client->createEvaluation([
                'EvaluationDataSourceId' => $DataSourceId,
                'EvaluationId' => $EvaluationId,
                'EvaluationName' => $EvaluationName,
                'MLModelId' => $MLModelId,
            ]);

        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }

        return back();
    }


    public function createBatchPrediction(Request $request)
    {
        
        $DataSourceId = $request->input('DataSourceId');
        $BatchPredictionId = 'bp-' . uniqid();
        $BatchPredictionName = $request->input('BatchPredictionName');
        $MLModelId = $request->input('MLModelId');
        $OutputUri = 's3://' . $this->bucket . '/bathPrediction/';

        try {
           $result = $this->client->createBatchPrediction([
                'BatchPredictionDataSourceId' => $DataSourceId, // REQUIRED
                'BatchPredictionId' => $SBatchPredictionId, // REQUIRED
                'BatchPredictionName' => $BatchPredictionName,
                'MLModelId' => $MLModelId, // REQUIRED
                'OutputUri' => $OutputUri, // REQUIRED
            ]);

        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }

        return back();
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
