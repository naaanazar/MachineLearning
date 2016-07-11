<?php
include_once 'ArraySort.php';
include_once 'GenerationArray.php';

$sort = new ArraySort;
$GenerationArray = new GenerationArray();

$arraySize = 3  ;

$arrList = $GenerationArray->makeArray($arraySize);


echo "------------------GENERAL------------------- <br />";

$sort->viewSortArray($arrList, $arraySize);

echo "-------------------FIRST------------------- <br />";

$sort->viewSortArray( $sort->first($arrList, $arraySize), $arraySize );

echo "------------------SECOND------------------- <br />";

$sort->viewSortArray( $sort->second($arrList, $arraySize), $arraySize );

echo "-------------------THERD------------------- <br />";

$sort->viewSortArray( $sort->therd($arrList, $arraySize), $arraySize );

echo "-------------------FOURTH------------------- <br />";

$sort->viewSortArray( $sort->fourth($arrList, $arraySize), $arraySize );



echo "<hr />";
$fp = fopen("file.txt", "a"); 
$arrs = array('one' => 'Раз', 'two' => 'Два');
foreach($arrList as $key1 => $arr1){
    foreach($arr1 as $key2 => $arr2){
        $test = fwrite($fp, $arr2."\t"); 
    }
    $test = fwrite($fp, "\r\n");
}
if ($test) echo 'YES';
else echo 'ERROR';
fclose($fp); 