<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Library\Generators\DatasetGenerator;

class GeneratorController extends Controller
{
    public function index()
    {        
        return view('generator');
    }

    public function updateDataset(Request $request)
    {
        $this->validate($request, [
            'rows' => 'required|integer'
        ]);

        $datasetFeeder = new DatasetGenerator();
        $datasetFeeder->rowsCount = $request->rows;
        $datasetFeeder->feed();

        $stats = array(
            'recordsNumber' => $datasetFeeder->rowsCount,
            'purchaseNumber' => $datasetFeeder->total,
            'purchasePercentage' => $datasetFeeder->percents,
            'path' => $datasetFeeder->targetFile
        );

        return view('generator', array('stats' => $stats));

    }
}
