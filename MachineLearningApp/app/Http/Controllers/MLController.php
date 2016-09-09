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

    public function listMLData()
    {
        $result['describeDataSources'] = $this->describeDataSources();
        $result['describeMLModels'] = $this->describeMLModels();
        $result['describeEvaluations'] = $this->describeEvaluations();
        $result['describeBatchPredictions'] = $this->describeBatchPredictions();

        return view('ml.index', ['result' => $result]);
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
                'SortOrder' => 'asc'
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
            $result['Message']];
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
            $result['Message']];
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
            $result['Message']];

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
            $result['Message']];

        return response()->json(['data' => (array)$arr]);
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


    public function getEndpointStatus($modelId)
    {
        $result = $this->client->getMLModel([
            'MLModelId' => $modelId,
            'Verbose' => true,
        ]);
        return $result['EndpointInfo']['EndpointStatus'];
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

        } catch (MachineLearningException $e) {
            echo $e->getMessage() . "\n";
        }

        return back();
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

        } catch (MachineLearningException $e) {
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
                'BatchPredictionId' => $BatchPredictionId, // REQUIRED
                'BatchPredictionName' => $BatchPredictionName,
                'MLModelId' => $MLModelId, // REQUIRED
                'OutputUri' => $OutputUri, // REQUIRED
            ]);

        } catch (MachineLearningException $e) {
            echo $e->getMessage() . "\n";
        }

        return back();
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
        $country                 = $request->input('country');
        $MLModelId               = $request->input('ml_model_id');
        $stringsCount            = $request->input('strings_count');
        $membersCount            = $request->input('members_count');
        $projectCount            = $request->input('projects_count');
        $emailCustomDomain       = $request->input('email_custom_domain');
        $hasPrivateProject       = $request->input('has_private_project');
        $daysAfterLastLogin      = $request->input('days_after_last_login');
        $sameEmailDomainCount    = $request->input('same_email_domain_count');
        $sameLoginAndProjectName = $request->input('same_login_and_project_name');

        $endPoint = $this->createRealtimeEndpoint($MLModelId);
        $predictEndpoint = $endPoint["RealtimeEndpointInfo"]["EndpointUrl"];
        $endpointStatus = $endPoint["RealtimeEndpointInfo"]["EndpointStatus"];

        // $point = 0;
        // while ($point !== 1) {
        //     if ($endpointStatus == "READY") $point = 1;
        //     else sleep(2);
        // }

        try {
            $result = $this->client->predict([
                'MLModelId' => $MLModelId, // REQUIRED
                'PredictEndpoint' => $predictEndpoint, // REQUIRED
                'Record' => [
                    "email_custom_domain" => $emailCustomDomain,
                    "same_email_domain_count" => $sameEmailDomainCount,
                    "projects_count" => $projectCount,
                    "strings_count" => $stringsCount,
                    "members_count" => $membersCount,
                    "has_private_project" => $hasPrivateProject,
                    "same_login_and_project_name" => $sameLoginAndProjectName,
                    "days_after_last_login" => $daysAfterLastLogin,
                    "country" => $country
                ]
            ]);

        } catch (MachineLearningException $e) {
            echo $e->getMessage() . "\n";
        }

        $this->deleteRealtimeEndpoint($MLModelId);
        $result = "Prediction: " . $result["Prediction"]["predictedLabel"];

        return redirect('/predictions')->with('result', $result);
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
