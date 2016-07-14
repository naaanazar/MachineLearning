<?php

ini_set('display_errors', E_ALL);

require_once '../vendor/autoload.php';

use yu\app\sorters\SortingArray;
use yu\app\ArraySorterFactory;
use yu\app\generators\StandartArrayGenerator;

echo"I`m working.GO AWAY!!".'<br>';

$SorterFactory = new ArraySorterFactory();
$generatedArray = StandartArrayGenerator::generate();

$a = new SortingArray();
echo"<hr>";

$a->printArrayStraight();
echo"<hr>";
$a->transposeArray();
echo"<hr>";

$a->transposeArrayInversion();
echo "<hr>";
$a->testArray();
echo "<hr>";