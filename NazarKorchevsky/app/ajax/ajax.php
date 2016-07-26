<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

echo date('H:i:s');
echo "<br>";

require __DIR__ . '/../../vendor/autoload.php';

use sa\app\NewArray;
use sa\app\ArrayOut;
use sa\app\DB\DBArray;
use sa\app\FactoryArray;

$array = newArray::$array;

$arrayOut = new ArrayOut;

if (isset($_POST['array'])) {

ob_start();
    $sorter = FactoryArray::getClass($_POST['array']);
    $sorter->setOrder('ASC');
    $arrayOut->arrayOut($sorter->sort());
$out = ob_get_contents();
ob_end_clean();

$DB = new DBArray;
$DB->insertArray($out);
$out = $DB->selectArray();
echo $out;
}

