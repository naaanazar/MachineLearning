<?php
require '__DIR___' . '/../../vendor/autoload.php';

use ex\app\ArraySort;
use ex\app\ArrayView;
use ex\app\GenerationArray;
use ex\app\WriteFile;

$generationArray = new GenerationArray();
$arrayView = new ArrayView();
$arraySort = new ArraySort();
$writeFile = new WriteFile();

$arraySize = 5;
$arrayOriginal = $generationArray->makeArray($arraySize);

$Array1 = $arraySort->first($arrayOriginal, $arraySize);
$Array2 = $arraySort->second($arrayOriginal, $arraySize);
$Array3 = $arraySort->therd($arrayOriginal, $arraySize);
$Array4 = $arraySort->fourth($arrayOriginal, $arraySize);

$arrayView->viewSortArray($Array1, $arraySize);
$arrayView->viewSortArray($Array2, $arraySize);
$arrayView->viewSortArray($Array3, $arraySize);
$arrayView->viewSortArray($Array4, $arraySize);

$writeFile->writeArrayInFile('file.txt', $Array1);
