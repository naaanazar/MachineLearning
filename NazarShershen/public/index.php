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

for($z = 0; $z < 10000; $z++) {

    $straight->sortArray();
    $array = array();
    $str = "";
    for($i = 0; $i < 5; $i++) {

        $str .= chr(rand(97, 122));

        for($j = 0; $j < 5; $j++) {
            $array[$i][$j] = rand(0, 100);
        }

    }

    $key = $str;

    $straight->saveArrayToDB($key, $array);
}
//$straight->displayArray();
//
//$vertical = $factory->getSorter("verticalSort");
//$vertical->sortArray();
//$vertical->displayArray();
//$vertical->flag = true;
//$vertical->sortArray();
//$vertical->displayArray();

