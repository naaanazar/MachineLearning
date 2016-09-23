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
            'version'     => 'latest',
            'region'      => 'us-east-1',
            'credentials' => [
                'key'    => getenv('ML_KEY'),
                'secret' => getenv('ML_SECRET')
            ]
        ]);

        return $ml;
    }


    public function describeDataSources()
    {
        try {
            $result = $this->client->describeDataSources([]);
        } catch (MachineLearningException $e) {
            echo $e->getMessage()."\n";
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
            echo $e->getMessage()."\n";
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
            echo $e->getMessage()."\n";
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
            echo $e->getMessage()."\n";
        }

        return $result['Results'];
    }


    public function statusDataSource($DataSourceId)
    {
        try {
            $result = $this->client->getDataSource([
                'DataSourceId' => $DataSourceId,
                'Verbose'      => true || false,
            ]);

        } catch (MachineLearningException $e) {
            echo $e->getMessage()."\n";
        }

        return response()->json(['data' => $result['Status']]);
    }

}