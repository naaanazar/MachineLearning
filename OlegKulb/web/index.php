<?php
require '__DIR___' . '/../../vendor/autoload.php';

use ex\app\ArraySort;
use ex\app\WriteFile;

$arraySize = 5;
$arraySort = new ArraySort($arraySize);
//$writeFile = new WriteFile();

$Array1 = $arraySort->first();
$Array2 = $arraySort->second();
$Array3 = $arraySort->therd();
$Array4 = $arraySort->fourth();

//$writeFile->writeArrayInFile('file.txt', $Array1);
