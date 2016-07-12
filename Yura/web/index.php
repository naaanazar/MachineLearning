 <?php
 
require "../app/Matrix.php";
use Figure\Matrix as Matrix;
$matrix = new Matrix();
$matrix->outHTML();
$matrix->reverse();
$matrix->outHTML();
$matrix->clear();
$matrix->secondReverse();
$matrix->outHTML();/*
