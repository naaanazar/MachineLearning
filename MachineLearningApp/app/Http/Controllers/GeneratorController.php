<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\GeneratorRequest;
use App\Http\Controllers\Controller;
use App\Library\Generators\DatasetGenerator;

class GeneratorController extends Controller
{
    public function doIndex()
    {
        return view('generator.generator', ['maxRowsCount' => DatasetGenerator::MAX_ROWS_COUNT]);
    }

    public function doGenerateDataset(GeneratorRequest $request)
    {
        $generator = new DatasetGenerator();
        $generator->setRowsCount($request->rows);
        $generator->generate();

        $stats = [
            'recordsNumber'      => $generator->getRowsCount(),
            'purchaseNumber'     => $generator->getTotal(),
            'purchasePercentage' => $generator->getPurchasePersentage(),
            'path'               => basename($generator->getTargetFile()),
        ];

        return response()->json(['stats' => $stats]);
    }
}
