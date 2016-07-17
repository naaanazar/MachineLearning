<?php

ini_set("display_errors", 1);
error_reporting(E_ALL);

require __DIR__ .'/vendor/autoload.php'; 

use liw\app\ArraySorterFactory;

$factory = new ArraySorterFactory();


$sortObj = $factory->getSort("HorisontalSortClass");
$aaa = $sortObj->sortArr();

foreach ($aaa as $row) {
    foreach ($row as $item) {
        echo $item . "&nbsp";
        
        if ($item < 10) {
            echo "&nbsp;&nbsp;";
        }
    }
    
    echo "</br>";
    
}

echo '------------------------------------------------';
echo '<br />';


$sortObj = $factory->getSort("VerticalSortClass");
$a = $sortObj->sortArr();
$sortObj->displayArray($a);

$sortObj->flag = true;
$a = $sortObj->sortArr();
$sortObj->displayArray($a);

