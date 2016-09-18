<?php

namespace App\Http\Controllers;

use URL;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Aws\MachineLearning\MachineLearningClient;
use Aws\MachineLearning\Exception\MachineLearningException;

use App\Library\AWS\S3;
use App\Library\AWS\ML;


class MLController extends Controller
{

    private $bucket = 'ml-datasets-test';
    private $client;
    private $DataSchema = '{"version":"1.0",
        "rowId":null,
        "rowWeight":null,
        "targetAttributeName":"purchase",
        "dataFormat":"CSV",
        "dataFileContainsHeader":true,
        "attributes":[{
           "attributeName":"email_custom_domain","attributeType":"BINARY"},
           {"attributeName":"same_email_domain_count","attributeType":"NUMERIC"},
           {"attributeName":"projects_count","attributeType":"NUMERIC"},
           {"attributeName":"strings_count",
           "attributeType":"NUMERIC"},
           {"attributeName":"members_count",
           "attributeType":"NUMERIC"},
           {"attributeName":"has_private_project",
           "attributeType":"BINARY"},
           {"attributeName":"same_login_and_project_name",
           "attributeType":"BINARY"},
           {"attributeName":"days_after_last_login",
           "attributeType":"NUMERIC"},
           {"attributeName":"country",
           "attributeType":"CATEGORICAL"},
           {"attributeName":"purchase","attributeType":"BINARY"}],
           "excludedAttributeNames":[]
    }';

    private $DataSchemaBatch = '{"version":"1.0",
        "rowId":null,
        "rowWeight":null,
        "dataFormat":"CSV",
        "dataFileContainsHeader":true,
        "attributes":[{
           "attributeName":"email_custom_domain","attributeType":"BINARY"},
           {"attributeName":"same_email_domain_count","attributeType":"NUMERIC"},
           {"attributeName":"projects_count","attributeType":"NUMERIC"},
           {"attributeName":"strings_count",
           "attributeType":"NUMERIC"},
           {"attributeName":"members_count",
           "attributeType":"NUMERIC"},
           {"attributeName":"has_private_project",
           "attributeType":"BINARY"},
           {"attributeName":"same_login_and_project_name",
           "attributeType":"BINARY"},
           {"attributeName":"days_after_last_login",
           "attributeType":"NUMERIC"},
           {"attributeName":"country",
           "attributeType":"CATEGORICAL"}],
           "excludedAttributeNames":[]
    }';

    public function __construct()
    {
        $this->client = $this->connectToML();
    }

    public function index()
    {
        return view('ml.index');
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

    public function listDataSources()
    {

        $ml = new ML;
        $result = $ml->describeDataSources();

        return response()->json(['data' => (array)$result]);
    }

    public function listMLModels()
    {
        $ml = new ML;
        $result = $ml->describeMLModels();

        return response()->json(['data' => (array)$result]);
    }
    public function listEvaluations()
    {
        $ml = new ML;
        $result = $ml->describeEvaluations();

        return response()->json(['data' => (array)$result]);
    }

    public function listBatchPredictions()
    {
        $ml = new ML;
        $result = $ml->describeBatchPredictions();

        return response()->json(['data' => (array)$result]);
    }

    public function selectObjectsS3()
    {
        $s3 = new S3;
        $result = $s3->ListObjectsS3();

        return response()->json(['data' => (array)$result]);
    }

    public function selectDataSources()
    {
        $ml = new ML;
        $result = $ml->describeDataSources();

        return response()->json(['data' => (array)$result]);
    }

    public function selectMLModel()
    {
        $ml = new ML;
        $result = $ml->describeMLModels();

        return response()->json(['data' => (array)$result]);
    }      

    public function getDataSource($DataSourceId)
    {
        try {
            $result = $this->client->getDataSource([
                'DataSourceId' => $DataSourceId,
                'Verbose' => true || false,
            ]);

        } catch (MachineLearningException $e) {
            echo $e->getMessage() . "\n";
        }
        $arr = [$result['Name'],
            $result['DataSizeInBytes'],
            $result['NumberOfFiles'],
            $result['Message'],
            $result['DataLocationS3'],
            $result['DataSourceId']
        ];

        return response()->json(['data' => (array)$arr]);
    }

    public function getMLModel($ModelId)
    {
        try {
            $result = $this->client->getMLModel([
                'MLModelId' => $ModelId,
                'Verbose' => true,
            ]);

        } catch (MachineLearningException $e) {
            echo $e->getMessage() . "\n";
        }
        $arr = [$result['Name'],
            $result['SizeInBytes'],
            $result['InputDataLocationS3'],
            $result['Message'],
            $result['MLModelId'],
            $result['TrainingDataSourceId']
        ];
        return response()->json(['data' => (array)$arr]);
    }

    public function getEvaluation($EvaluationId)
    {
        try {
            $result = $this->client->getEvaluation([
                'EvaluationId' => $EvaluationId,
            ]);

        } catch (MachineLearningException $e) {
            echo $e->getMessage() . "\n";
        }
        $arr = [$result['Name'],
            $result['ComputeTime'],
            $result['InputDataLocationS3'],
            $result['Message'],
            $result['EvaluationId'],
            $result['MLModelId'],
            $result['EvaluationDataSourceId']
        ];

        return response()->json(['data' => (array)$arr]);
    }

    public function getBatchPrediction($getBatchPredictionId)
    {
        try {
            $result = $this->client->getBatchPrediction([
                'BatchPredictionId' => $getBatchPredictionId,
            ]);

        } catch (MachineLearningException $e) {
            echo $e->getMessage() . "\n";
        }
        $arr = [$result['Name'],
            $result['ComputeTime'],
            $result['InputDataLocationS3'],
            $result['Message'],
            $result['BatchPredictionId'],
            $result['BatchPredictionDataSourceId'],
            $result['MLModelId'],
        ];

        return response()->json(['data' => (array)$arr]);
    }

    public function deleteDataSource($DataSourceId)
    {
        try {
            $result = $this->client->deleteDataSource([
                'DataSourceId' => $DataSourceId,
            ]);

            return response()->json(['deleted' => 'Ok']);

        } catch (MachineLearningException $e) {
            echo $e->getMessage() . "\n";
        }
    }

    public function deleteEvaluation($EvaluationId)
    {
        try {
            $result = $this->client->deleteEvaluation([
                'EvaluationId' => $EvaluationId,
            ]);

            return response()->json(['deleted' => 'Ok']);

        } catch (MachineLearningException $e) {
            echo $e->getMessage() . "\n";
        }
    }

    public function deleteMLModel($MLModelId)
    {
        try {
            $result = $this->client->deleteMLModel([
                'MLModelId' => $MLModelId,
            ]);

            return response()->json(['deleted' => 'Ok']);

        } catch (MachineLearningException $e) {
            echo $e->getMessage() . "\n";
        }
    }

    public function deleteBatchPrediction($BatchPredictionId)
    {
        try {
            $result = $this->client->deleteBatchPrediction([
                'BatchPredictionId' => $BatchPredictionId,
            ]);

            return response()->json(['deleted' => 'Ok']);

        } catch (MachineLearningException $e) {
            echo $e->getMessage() . "\n";
        }
    }

    public function deleteRealtimeEndpoint(Request $request)
    {
        $MLModelId = $request->id;

        try {
            $result = $this->client->deleteRealtimeEndpoint([
                'MLModelId' => $MLModelId,
            ]);

        } catch (MachineLearningException $e) {
            echo $e->getMessage() . "\n";
        }
        return response()->json(['data' => $MLModelId]);
    }
    
}
