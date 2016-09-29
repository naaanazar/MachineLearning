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

    private $ml;

    private $DataSchema = [
        "version"                => "1.0",
        "rowId"                  => null,
        "rowWeight"              => null,
        "targetAttributeName"    => "purchase",
        "dataFormat"             => "CSV",
        "dataFileContainsHeader" => true,
        "attributes"             => [
            [
                "attributeName" => "email_custom_domain",
                "attributeType" => "BINARY"
            ],
            [
                "attributeName" => "same_email_domain_count",
                "attributeType" => "NUMERIC"
            ],
            [
                "attributeName" => "projects_count",
                "attributeType" => "NUMERIC"
            ],
            [
                "attributeName" => "strings_count",
                "attributeType" => "NUMERIC"
            ],
            [
                "attributeName" => "members_count",
                "attributeType" => "NUMERIC"
            ],
            [
                "attributeName" => "has_private_project",
                "attributeType" => "BINARY"
            ],
            [
                "attributeName" => "same_login_and_project_name",
                "attributeType" => "BINARY"
            ],
            [
                "attributeName" => "days_after_last_login",
                "attributeType" => "NUMERIC"
            ],
            [
                "attributeName" => "country",
                "attributeType" => "CATEGORICAL"
            ],
            ["attributeName" => "purchase", "attributeType" => "BINARY"]
        ]
    ];

    private $DataSchemaBatch = [
        "version"                => "1.0",
        "rowId"                  => null,
        "rowWeight"              => null,
        "dataFormat"             => "CSV",
        "dataFileContainsHeader" => true,
        "attributes"             => [
            [
                "attributeName" => "email_custom_domain",
                "attributeType" => "BINARY"
            ],
            [
                "attributeName" => "same_email_domain_count",
                "attributeType" => "NUMERIC"
            ],
            [
                "attributeName" => "projects_count",
                "attributeType" => "NUMERIC"
            ],
            [
                "attributeName" => "strings_count",
                "attributeType" => "NUMERIC"
            ],
            [
                "attributeName" => "members_count",
                "attributeType" => "NUMERIC"
            ],
            [
                "attributeName" => "has_private_project",
                "attributeType" => "BINARY"
            ],
            [
                "attributeName" => "same_login_and_project_name",
                "attributeType" => "BINARY"
            ],
            [
                "attributeName" => "days_after_last_login",
                "attributeType" => "NUMERIC"
            ],
            [
                "attributeName" => "country",
                "attributeType" => "CATEGORICAL"
            ]
        ]
    ];


    public function __construct()
    {
        $this->client = $this->connectToML();

        if (isset($_GET['Obj'])) {
            $this->ml  = new ML;
        }
    }


    public function index()
    {
        return view('ml.index');
    }


    private function connectToML()
    {
        $mlClient = new MachineLearningClient([
            'version'     => 'latest',
            'region'      => 'us-east-1',
            'credentials' => [
                'key'    => getenv('ML_KEY'),
                'secret' => getenv('ML_SECRET')
            ]
        ]);

        return $mlClient;
    }


    public function doListDataSources()
    {
        $result = $this->ml->describeDataSources();      

        return response()->json(['data' => (array)$result]);
    }


    public function doListMLModels()
    {
        $result = $this->ml->describeMLModels();

        foreach ($result as $key => $value) {

            $resultDs = $this->client->getDataSource([
            'DataSourceId' => $value['TrainingDataSourceId'], 
            'Verbose' =>  false,
            ]);

            $result[$key]['TrainingDataSourceName'] = $resultDs['Name'];
        }

        return response()->json(['data' => (array)$result]);
    }


    public function doListEvaluations()
    {
        $result = $this->ml->describeEvaluations();

        foreach ($result as $key => $value) {
       

            $resultML = $this->client->getMLModel([
                'MLModelId' => $value['MLModelId'],
                'Verbose' => false,
            ]);
            $result[$key]['ModelName'] = $resultML['Name'];

            $resultDs = $this->client->getDataSource([
            'DataSourceId' => $value['EvaluationDataSourceId'],
            'Verbose' =>  false,
            ]);

            $result[$key]['EvDatasourceName'] = $resultDs['Name'];
        }

        return response()->json(['data' => (array)$result]);
    }


    public function doListBatchPredictions()
    {
        $result = $this->ml->describeBatchPredictions();

        foreach ($result as $key => $value) {

            $resultML = $this->client->getMLModel([
                'MLModelId' => $value['MLModelId'],
                'Verbose' => false,
            ]);
            $result[$key]['ModelName'] = $resultML['Name'];
        }

        return response()->json(['data' => (array)$result]);
    }

    
    public function doSelectObjectsS3(Request $request)
    {
        $bucket= $request->bucket;
        $s3 = new S3;
        $client= $s3->getClient();
        try {
            $result = $client->listObjects([
                'Bucket' => $bucket,

            ]);

            $result = $result['Contents'];

        } catch (S3Exception $e) {
            echo $e->getMessage()."\n";
        }

        return response()->json(['data' => (array)$result]);
    }


    public function doSelectDataSources()
    {
        $result = $this->ml->describeDataSources();

        return response()->json(['data' => (array)$result]);
    }


    public function doSelectMLModel()
    {
        $result = $this->ml->describeMLModels();

        return response()->json(['data' => (array)$result]);
    }


    public function doGetDataSource($DataSourceId)
    {
        try {
            $result = $this->client->getDataSource([
                'DataSourceId' => $DataSourceId,
                'Verbose'      => true || false,
            ]);

        } catch (MachineLearningException $e) {

            return response()->json(['data' => $e->getMessage()]);
        }
        $arr = [
            $result['Name'],
            $result['DataSizeInBytes'],
            $result['NumberOfFiles'],
            $result['Message'],
            $result['DataLocationS3'],
            $result['DataSourceId']
        ];

        return response()->json(['data' => (array)$arr]);
    }


    public function doGetMLModel($ModelId)
    {
        try {
            $result = $this->client->getMLModel([
                'MLModelId' => $ModelId,
                'Verbose'   => true,
            ]);

        } catch (MachineLearningException $e) {

            return response()->json(['data' => $e->getMessage()]);
        }
        $arr = [
            $result['Name'],
            $result['SizeInBytes'],
            $result['InputDataLocationS3'],
            $result['Message'],
            $result['MLModelId'],
            $result['TrainingDataSourceId']
        ];

        return response()->json(['data' => (array)$arr]);
    }


    public function doGetEvaluation($EvaluationId)
    {
        try {
            $result = $this->client->getEvaluation([
                'EvaluationId' => $EvaluationId,
            ]);

        } catch (MachineLearningException $e) {

            return response()->json(['data' => $e->getMessage()]);
        }
        $arr = [
            $result['Name'],
            $result['ComputeTime'],
            $result['InputDataLocationS3'],
            $result['Message'],
            $result['EvaluationId'],
            $result['MLModelId'],
            $result['EvaluationDataSourceId']
        ];

        return response()->json(['data' => (array)$arr]);
    }


    public function doGetBatchPrediction($getBatchPredictionId)
    {
        try {
            $result = $this->client->getBatchPrediction([
                'BatchPredictionId' => $getBatchPredictionId,
            ]);

        } catch (MachineLearningException $e) {

            return response()->json(['data' => $e->getMessage()]);
        }
        $arr = [
            $result['Name'],
            $result['ComputeTime'],
            $result['InputDataLocationS3'],
            $result['Message'],
            $result['BatchPredictionId'],
            $result['BatchPredictionDataSourceId'],
            $result['MLModelId'],
        ];

        return response()->json(['data' => (array)$arr]);
    }


    public function doDeleteDataSource($DataSourceId)
    {
        try {
            $result = $this->client->deleteDataSource([
                'DataSourceId' => $DataSourceId,
            ]);

            return response()->json(['deleted' => 'Ok']);

        } catch (MachineLearningException $e) {
            return response()->json(['data' => $e->getMessage()]);
        }
    }


    public function doDeleteEvaluation($EvaluationId)
    {
        try {
            $result = $this->client->deleteEvaluation([
                'EvaluationId' => $EvaluationId,
            ]);

            return response()->json(['deleted' => 'Ok']);

        } catch (MachineLearningException $e) {
            return response()->json(['data' => $e->getMessage()]);
        }
    }


    public function doDeleteMLModel($MLModelId)
    {
        try {
            $result = $this->client->deleteMLModel([
                'MLModelId' => $MLModelId,
            ]);

        } catch (MachineLearningException $e) {
            return response()->json(['data' => $e->getMessage()]);
        }

        return response()->json(['deleted' => 'Ok']);
    }


    public function doDeleteBatchPrediction($BatchPredictionId)
    {
        try {
            $result = $this->client->deleteBatchPrediction([
                'BatchPredictionId' => $BatchPredictionId,
            ]);

        } catch (MachineLearningException $e) {
            return response()->json(['data' => $e->getMessage()]);
        }



        return response()->json(['deleted' => 'Ok']);
    }


    public function DoDeleteRealtimeEndpoint(Request $request)
    {
        $MLModelId = $request->id;

        try {
            $result = $this->client->deleteRealtimeEndpoint([
                'MLModelId' => $MLModelId,
            ]);

        } catch (MachineLearningException $e) {
            return response()->json(['data' => $e->getMessage()]);
        }

        return response()->json(['data' => $MLModelId]);
    }


    public function DoCreateDataSourceFromS3(Request $request)
    {
        $DataSourceName    = $request->input('DataSourceName');
        $DataLocationS3    = 's3://'. $request->input('SelectBuckets').  '/'.$request->input('DataLocationS3');
        $percentBegin  =  '0';
        $percentEnd    =  '100';
       
        $result = $this->createDataSourceFromS3($DataSourceName, $DataLocationS3, $percentBegin, $percentEnd);

        return response()->json([(array)$result]);
    }

    private function createDataSourceFromS3($DataSourceName, $DataLocationS3, $percentBegin, $percentEnd)
    {
        $DataSourceId      = '1' . uniqid();
        $DataSchema        = json_encode($this->DataSchema);
        $dataRearrangement = ["splitting" => [
           "percentBegin"  =>  $percentBegin,
           "percentEnd"    =>  $percentEnd,
           ]
       ];
       $data= json_encode($dataRearrangement);

        try {
            $result = $this->client->createDataSourceFromS3([
                'ComputeStatistics' => true,
                'DataSourceId'      => $DataSourceId,
                'DataSourceName'    => $DataSourceName,
                'DataSpec'          => [
                    'DataLocationS3'    => $DataLocationS3,
                    'DataRearrangement' => $data,
                    'DataSchema'        => $DataSchema
                ],
            ]);

        } catch (MachineLearningException $e) {
            $res['error'] = $e->getMessage();

            return $res;
        }
        $res['success'] = $result['DataSourceId'];

        return $res;
    }

    public function doCreateMainMLModel(Request $request)
    {
        $name    = $request->input('MLModelName');
        $DataLocationS3    = 's3://'. $request->input('SelectBuckets').  '/'.$request->input('DataLocationS3');

        $dsTraining = $this->createDataSourceFromS3('ds-training: ' . $name, $DataLocationS3, '0', '70');

        if (array_key_exists('error', $dsTraining)){
            $dsTraining['description'] = 'Error created training datasource';

                return response()->json([(array)$dsTraining]);
        }

        $dsEvaluate = $this->createDataSourceFromS3('ds-evaluate: ' . $name, $DataLocationS3, '70', '100');

        if (array_key_exists('error', $dsEvaluate)) {
            $dsEvaluate['description'] = 'Error created evaluate datasource';

            return response()->json([(array)$dsEvaluate]);
        }        

        $model = $this->createMLModel($name, $dsTraining['success']);

        if (array_key_exists('error', $model )) {
            $model['description'] = 'Error created model';

            return response()->json([(array)$model]);
        }

        $evaluation = $this->createEvaluation($model['success'], 'ev-: ' . $name, $dsEvaluate['success']) ;

        if (array_key_exists('error', $evaluation )) {
            $evaluation['description'] = 'Error created evaluatin';

            return response()->json([(array)$evaluation]);
        }
        
        $result['success'] =
            'model: ' . $name. '<br>' .
            'ds-training: ' . $name . '<br>' .
            'ds-evaluate: ' . $name . '<br>' .            
            'ev-: ' . $name . '<br>';   

        return response()->json([(array)$result]);
    }


    public function doCreateMLModel(Request $request)
    {
        $DataSourceId = $request->input('DataSourceId');

        $result = $this->client->getDataSource([
            'DataSourceId' => $DataSourceId, // REQUIRED
            'Verbose' =>  false,
        ]);

        $ModelName    = 'ml: ' . $request->input('MLModelName');

        $s3 = new S3;       

        if ($s3->fileExists($result['DataLocationS3']) == true) {
            $result = $this->createMLModel($ModelName, $DataSourceId);
            return response()->json([(array)$result]);

        } else {        
            $res['noExistDataset'] = true;
            return response()->json([(array)$res]);
        } 
    }

    private function createMLModel($ModelName, $DataSourceId)
    {
        $ModelId      = uniqid();
        $ModelType    = 'BINARY';

        try {

            $result = $this->client->createMLModel([
                'MLModelId'            => $ModelId,
                'MLModelName'          => $ModelName,
                'MLModelType'          => $ModelType,
                'TrainingDataSourceId' => $DataSourceId,
            ]);

        } catch (MachineLearningException $e) {
            $res['error'] = $e->getMessage();

            return $res;
        }
        $res['success'] = $result['MLModelId'];

        return $res;
    }


    public function doCreateEvaluation(Request $request)
    {
        $DataSourceId   = $request->input('DataSourceId'); 
        $EvaluationName = $request->input('EvaluationName');
        $MLModelId      = $request->input('MLModelId');

        $result = $this->client->getDataSource([
            'DataSourceId' => $DataSourceId,
            'Verbose' =>  false,
        ]);


        $EvaluationName = 'ev: ' . $request->input('EvaluationName');

        $s3 = new S3;

        if ($s3->fileExists($result['DataLocationS3']) == true) {
            $result = $this->createEvaluation($MLModelId, $EvaluationName, $DataSourceId);

            return response()->json([(array)$result]);
        } else {
            $res['noExistDataset'] = true;

            return response()->json([(array)$res]);
        }
        
    }


    private function createEvaluation($MLModelId, $EvaluationName, $DataSourceId)
    {
        $EvaluationId   = uniqid('e');

        try {

            $result = $this->client->createEvaluation([
                'EvaluationDataSourceId' => $DataSourceId,
                'EvaluationId'           => $EvaluationId,
                'EvaluationName'         => $EvaluationName,
                'MLModelId'              => $MLModelId,
            ]);

        } catch (MachineLearningException $e) {
            $res['error'] = $e->getMessage();

            return $res;
        }
        $res['success'] = $result['EvaluationId'];

        return $res;
    }


    public function doCreateBatchPrediction(Request $request)
    {
        $S3     = new S3; 

        $client = $S3->getClient();
        $client->registerStreamWrapper();

        $file     = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $data     = file_get_contents($file);

        $result = $client->putObject([
            'Bucket' => $this->bucket,
            'Key'    => $fileName,
            'Body'   => $data,
            'ACL'    => 'public-read',
        ]);

        $DataSourceId        = $this->createBatchDataSourceFromS3($fileName);
        $BatchPredictionId   = '1'. uniqid();
        $BatchPredictionName = $BatchPredictionId;
        $MLModelId           = $request->input('MLModelId');
        $OutputUri           = 's3://'.$this->bucket.'/';

        try {
            $result = $this->client->createBatchPrediction([
                'BatchPredictionDataSourceId' => $DataSourceId,
                'BatchPredictionId'           => $BatchPredictionId,
                'BatchPredictionName'         => $BatchPredictionName,
                'MLModelId'                   => $MLModelId,
                'OutputUri'                   => $OutputUri,
            ]);

        } catch (MachineLearningException $e) {
            return response()->json(['error' => $e->getMessage()]);
        }

        return response()->json(['success' => $result['BatchPredictionId']]);

    }


    private function createBatchDataSourceFromS3($fileName)
    {
        $DataSourceId   = uniqid();
        $DataLocationS3 = 's3://'.$this->bucket.'/'.$fileName;
        $DataSchema     = json_encode($this->DataSchemaBatch);

        try {
            $result = $this->client->createDataSourceFromS3([
                'ComputeStatistics' => true,
                'DataSourceId'      => $DataSourceId,
                'DataSourceName'    => $DataSourceId,
                'DataSpec'          => [ // REQUIRED
                    'DataLocationS3' => $DataLocationS3,
                    'DataSchema'     => $DataSchema
                ],
            ]);

        } catch (MachineLearningException $e) {
            //return response()->json(['data' => $e->getMessage()]);
        }

        return $result['DataSourceId'];

    }

}
