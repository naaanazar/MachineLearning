<?php

ini_set('display_errors', E_ALL);

require_once '../vendor/autoload.php';

use yu\app\arrayClass;

echo"I`m working.GO AWAY!!".'<br>';
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
echo "<hr>";