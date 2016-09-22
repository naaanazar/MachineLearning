<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\GeneratorRequest;
use App\Http\Controllers\Controller;
use App\Library\Generators\DatasetGenerator;

class GeneratorController extends Controller
{

    public function index()
    {
        return view('generator.generator');
    }


    public function generateDataset(GeneratorRequest $request)
    {

        $datasetFeeder            = new DatasetGenerator();
        $datasetFeeder->rowsCount = $request->rows;
        $datasetFeeder->feed();

        $stats = [
            'recordsNumber'      => $datasetFeeder->rowsCount,
            'purchaseNumber'     => $datasetFeeder->total,
            'purchasePercentage' => $datasetFeeder->percents,
            'path'               => basename($datasetFeeder->targetFile),
        ];

        return json_encode(['stats' => $stats]);
    }

}
