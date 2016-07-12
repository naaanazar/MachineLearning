 <?php

 
require "Matrix.php";
use Figure\Matrix;


$matrix = new Matrix();
$matrix->outHTML();
/*
$matrix->reverse();
$matrix->outHTML();

$matrix->clear();
$matrix->secondReverse();
$matrix->outHTML();*/
$matrix->spiralSort();