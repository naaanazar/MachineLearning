 <?php

 
require __DIR__."/../vendor/autoload.php";

use app\Figure\Matrix;


$matrix = new Matrix();
$matrix->outHTML();


$matrix->reverse();
$matrix->outHTML();

$matrix->clear();
$matrix->secondReverse();
$matrix->outHTML();

$matrix->clear();
$matrix->spiralSort() ;
$matrix->outHTML();