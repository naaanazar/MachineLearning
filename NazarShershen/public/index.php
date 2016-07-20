<?php

error_reporting(E_ALL & ~E_NOTICE);
ini_set("display_errors", 1);

require __DIR__ . '/../vendor/autoload.php';

use arr\app\ArraysFactory;

$factory = new ArraysFactory();

//$snake = $factory->getSorter("snakeSort");
//$snake->sortArray();
//echo "<hr>";

$straight = $factory->getSorter("straightSort");
$straight->sortArray();
$straight->saveArrayToDB("straightSort");
//$straight->displayArray();
//
//$vertical = $factory->getSorter("verticalSort");
//$vertical->sortArray();
//$vertical->displayArray();
//$vertical->flag = true;
//$vertical->sortArray();
//$vertical->displayArray();

