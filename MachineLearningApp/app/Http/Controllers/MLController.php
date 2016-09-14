<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Aws\MachineLearning\MachineLearningClient;
use Aws\MachineLearning\Exception\MachineLearningException;

use App\Http\Controllers\S3Controller;

class MLController extends Controller
{

    public $bucket = 'ml-datasets-test';
    private $client;
    public $DataSchema = '{"version":"1.0",
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

    public $DataSchemaBatch = '{"version":"1.0",
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

    function __construct()
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
        $result = $this->describeDataSources();

        return response()->json(['data' => (array)$result]);
    }


    public function listMLModels()
    {
        $result = $this->describeMLModels();

        return response()->json(['data' => (array)$result]);
    }

    public function listEvaluations()
    {
        $result = $this->describeEvaluations();

        return response()->json(['data' => (array)$result]);
    }

    public function listBatchPredictions()
    {
        $result = $this->describeBatchPredictions();

        return response()->json(['data' => (array)$result]);
    }

    public function selectObjectsS3()
    {
        $list = new S3Controller;
        $result = $list->ListObjectsS3();
        return response()->json(['data' => (array)$result]);
    }


    public function selectDataSources()
    {
        $result = $this->describeDataSources();
        return response()->json(['data' => (array)$result]);

    }


    public function selectMLModel()
    {
        $result = $this->describeMLModels();
        return response()->json(['data' => (array)$result]);

    }


        public function describeDataSources()
    {

        try {

            $result = $this->client->describeDataSources([           
            ]);

        } catch (MachineLearningException $e) {
            echo $e->getMessage() . "\n";
        }
        //dd($result);
        return $result['Results'];
    }

    //test
    public function getD()
    {
        try {
            $result = $this->client->getDataSource([
                'DataSourceId' => 'ds-57d7eb2c8c3d7',
                'Verbose' => true || false,
            ]);

        } catch (MachineLearningException $e) {
            echo $e->getMessage() . "\n";
        }

        dd($result);


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
            $result['DataSourceId']];
        //dd($result);

        return response()->json(['data' => (array)$arr]);
    }

    public function getMLModel($ModelId)
    {
        try {
            $result = $this->client->getMLModel([
                'MLModelId' => $ModelId, // REQUIRED
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
            $result['TrainingDataSourceId']];
        //dd($arr);
        return response()->json(['data' => (array)$arr]);

    }

    public function getEvaluation($EvaluationId)
    {
        try {
            $result = $this->client->getEvaluation([
                'EvaluationId' => $EvaluationId, // REQUIRED
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
                'BatchPredictionId' => $getBatchPredictionId, // REQUIRED
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
                'DataSourceId' => $DataSourceId, // REQUIRED
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
                'EvaluationId' => $EvaluationId, // REQUIRED
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
                'MLModelId' => $MLModelId, // REQUIRED
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
                'BatchPredictionId' => $BatchPredictionId, // REQUIRED
            ]);

            return response()->json(['deleted' => 'Ok']);

        } catch (MachineLearningException $e) {
            echo $e->getMessage() . "\n";
        }

    }


    public function createDataSourceFromS3(Request $request)
    {

        $DataSourceId = uniqid();
        $DataSourceName = $request->input('DataSourceName');
        $DataLocationS3 = 's3://' . $this->bucket . '/' . $request->input('DataLocationS3');
        $DataSchema = $this->DataSchema;
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

        } catch (MachineLearningException $e) {
            return response()->json(['data' => $e->getMessage() ]);
        }

        return response()->json(['data' => (array)$result]);
    }


    public function createMLModel(Request $request)
    {

        $ModelId = 'ml-' . uniqid();
        $ModelName = $request->input('MLModelName');
        $ModelType = $request->input('MLModelType');
        $DataSourceId = $request->input('DataSourceId');

        try {

            $result = $this->client->createMLModel([
                'MLModelId' => $ModelId,
                'MLModelName' => $ModelName,
                'MLModelType' => $ModelType,
                'TrainingDataSourceId' => $DataSourceId,
            ]);

        } catch (MachineLearningException $e) {
            return response()->json(['data' => $e->getMessage() ]);
        }

        //return back();
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

        } catch (MachineLearningException $e) {
            return response()->json(['data' => $e->getMessage() ]);
        }

        //return back();
    }


    public function createBatchPrediction(Request $request)
    {

        $S3 = New S3Controller;
        $fileName = $S3->fileUpload($request);
        sleep(2);

        $DataSourceId = $this->createBatchDataSourceFromS3($fileName);
        sleep(4);

        $BatchPredictionId = 'bp-' . uniqid();
        $BatchPredictionName = $BatchPredictionId;
        $MLModelId = $request->input('MLModelId');
        $OutputUri = 's3://' . $this->bucket . '/';

        try {
            $result = $this->client->createBatchPrediction([
                'BatchPredictionDataSourceId' => $DataSourceId, // REQUIRED
                'BatchPredictionId' => $BatchPredictionId, // REQUIRED
                'BatchPredictionName' => $BatchPredictionName,
                'MLModelId' => $MLModelId, // REQUIRED
                'OutputUri' => $OutputUri, // REQUIRED
            ]);

        } catch (MachineLearningException $e) {
            return response()->json(['data' => $e->getMessage() ]);
        }

        return response()->json(['data' => $result['BatchPredictionId']]);
    }


    public function createBatchDataSourceFromS3($fileName)
    {
        $DataSourceId = uniqid();
        $DataLocationS3 = 's3://' . $this->bucket . '/' . $fileName ;
        $DataSchema = $this->DataSchemaBatch;

        try {
            $result = $this->client->createDataSourceFromS3([
                'ComputeStatistics' => true,
                'DataSourceId' => $DataSourceId, // REQUIRED
                'DataSourceName' => $DataSourceId,
                'DataSpec' => [ // REQUIRED
                    'DataLocationS3' => $DataLocationS3, // REQUIRED
                    'DataSchema' => $DataSchema
                ],
            ]);

        } catch (MachineLearningException $e) {
            return response()->json(['data' => $e->getMessage() ]);
        }
        return $result['DataSourceId'];
      
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

   
    public function createRealtimeEndpoint($MLModelId)
    {

        $client = $this->connectToML();

        try {
            $result = $client->createRealtimeEndpoint([
                'MLModelId' => $MLModelId // REQUIRED
            ]);

        } catch (MachineLearningException $e) {
            echo $e->getMessage() . "\n";
        }

        return $result;
    }

    public function deleteRealtimeEndpoint($MLModelId)
    {

        try {
            $result = $this->client->deleteRealtimeEndpoint([
                'MLModelId' => $MLModelId, // REQUIRED
            ]);

        } catch (MachineLearningException $e) {
            echo $e->getMessage() . "\n";
        }
    }

    public function predict(Request $request)
    {
        $country = $request->input('country');
        $MLModelId = $request->input('ml_model_id');
        $stringsCount = $request->input('strings_count');
        $membersCount = $request->input('members_count');
        $projectCount = $request->input('projects_count');
        $emailCustomDomain = $request->input('email_custom_domain');
        $hasPrivateProject = $request->input('has_private_project');
        $daysAfterLastLogin = $request->input('days_after_last_login');
        $sameEmailDomainCount = $request->input('same_email_domain_count');
        $sameLoginAndProjectName = $request->input('same_login_and_project_name');

        $endPoint = $this->createRealtimeEndpoint($MLModelId);

        $endpointStatus  = $endPoint["RealtimeEndpointInfo"]["EndpointStatus"];
        $predictEndpoint = $endPoint["RealtimeEndpointInfo"]["EndpointUrl"];

        if ($endpointStatus != 'READY') {
            $status = 'Updating';
            return $status;
        } else {
            try {
                $result = $this->client->predict([
                    'MLModelId'       => $MLModelId,
                    'PredictEndpoint' => $predictEndpoint,
                    'Record' => [
                        "country" => $country,
                        "members_count" => $membersCount,
                        "strings_count" => $stringsCount,
                        "projects_count" => $projectCount,
                        "has_private_project" => $hasPrivateProject,
                        "email_custom_domain" => $emailCustomDomain,
                        "days_after_last_login" => $daysAfterLastLogin,
                        "same_email_domain_count" => $sameEmailDomainCount,
                        "same_login_and_project_name" => $sameLoginAndProjectName,
                    ]
                ]);

            } catch (MachineLearningException $e) {
                echo $e->getMessage() . "\n";
            }

            $predictedLabel = $result["Prediction"]["predictedLabel"];
            $predictedScores = $result["Prediction"]["predictedScores"];
            $details = $result["Prediction"]["details"];
            $preScores = $predictedScores[0];
            $algorithm = $details["Algorithm"];
            $modelType = $details["PredictiveModelType"];

            $output = "<section class='pred-data'><h1 class='text-center'>Result</h1>"
                    . "<h4><strong>Prediction: </strong>" . $predictedLabel . "</h4>"
                    . "<h4><strong>Predicted Scores: </strong>" . $preScores . "</h4>"
                    . "<h4><strong>Algorithm: </strong>" . $algorithm . "</h4>"
                    . "<h4><strong>Model Type: </strong>" . $modelType . "</h4>"
                    . "</section>";

            $this->deleteRealtimeEndpoint($MLModelId);

            if($request->ajax()) return $output;
            else return false;
        }
    }

    public function updateDataSource($DataSourceId)
    {
        try {

            $result = $this->client->getDataSource([
                'DataSourceId' => $DataSourceId,
            ]);

            $this->client->updateDataSource([
                'DataSourceId' => $result['DataSourceId'],
                'DataSourceName' => $result['Name'],
            ]);


        } catch (MachineLearningException $e) {
            echo $e->getMessage() . "\n";
        }
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
                'BatchPredictionId' => $getBatchPredictionId, // REQUIRED
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
