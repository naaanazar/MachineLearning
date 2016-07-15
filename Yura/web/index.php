<?php

ini_set('display_errors', E_ALL);

require_once '../vendor/autoload.php';

//use yu\app\sorters\SortingArray;
use yu\app\ArraySorterFactory;
use yu\app\generators\GenerationArray;

echo"I`m working.GO AWAY!!".'<br>';

$generator = new GenerationArray();
$types = ArraySorterFactory::getAllTypes();

foreach($types as $type) {
    $sorter = ArraySorterFactory::getSorter($type);
    $sorter->setArray($generator->getArray());
    $sorter->setQuantity($generator->getQuantity());
    $sorter->sort();

    echo "<br>";
}
