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
        //echo '<pre>';
        //print_r($result);
        return view('ml.index',['result' => $result]);
    }
}
