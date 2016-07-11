<?php
include_once 'ArraySort.php';
include_once 'GenerationArray.php';

$sort = new ArraySort;
$GenerationArray = new GenerationArray();

$arraySize = 4;


$arrList = $GenerationArray->makeArray($arraySize);


echo "------------------GENERAL------------------- <br />";

$sort->viewSortArray($arrList, $arraySize);

echo "-------------------FIRST------------------- <br />";

$sort->viewSortArray( $sort->first($arrList, $arraySize), $arraySize );

echo "------------------SECOND------------------- <br />";

$sort->viewSortArray( $sort->second($arrList, $arraySize), $arraySize );

echo "-------------------THERD------------------- <br />";

$sort->viewSortArray( $sort->therd($arrList, $arraySize), $arraySize );

