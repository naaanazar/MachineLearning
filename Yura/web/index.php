<?php

ini_set('display_errors', E_ALL);

require_once '../vendor/autoload.php';

use yu\app\sorters\arrayClass;
use yu\app\ArraySorterFactory;

echo"I`m working.GO AWAY!!".'<br>';

$SorterFactory = new ArraySorterFactory();

$a = new arrayClass();
echo"<hr>";
$a->printArrayStraight();
echo"<hr>";
$a->transposeArray();
echo"<hr>";
$a->transposeArrayInversion();
echo "<hr>";
$a->testArray();
echo "<hr>";