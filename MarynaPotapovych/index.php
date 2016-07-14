<?php

ini_set("display_errors", 1);
error_reporting(E_ALL);

require __DIR__ .'/vendor/autoload.php'; 

use liw\app\ArraySorterFactory;

$factory = new ArraySorterFactory();

$sortObj = $factory->getSort("HorisontalSortClass");
$sortObj->sortArr();

$sortObj = $factory->getSort("VerticalSortClass");
$sortObj->sortArr();

$sortObj->flag = true;
$sortObj->sortArr();