<?php

error_reporting(E_ALL & ~E_NOTICE);
ini_set("display_errors", 1);

require __DIR__ . '/../vendor/autoload.php';

use arr\app\ArraysFactory;

$factory = new ArraysFactory();

$obj;

$obj = $factory->getSorter("snakeSort");
$obj->sortArray();
echo "<hr>";

$obj = $factory->getSorter("straightSort");
$obj->sortArray();
echo "<hr>";

$obj = $factory->getSorter("verticalSort");
$obj->sortArray();
echo "<hr>";
$obj->flag = true;
$obj->sortArray();
echo "<hr>";

