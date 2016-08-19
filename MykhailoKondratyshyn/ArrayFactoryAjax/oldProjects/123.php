<?php
$a = 5;
$b = 5;

$k = 1;

$array = array();


for ($i = 0; $i < 5; $i++) {
    for ($j = 0; $j < 5; $j++) {
        $array[$i][$j] = rand(0, 25);


        echo $array[$i][$j] . " ";

    }
    echo "<br>";

}

echo "<br>";echo "<br>";

sort($array);


for ($i = 0; $i < 5; $i++) {
    for ($j = 0; $j < 5; $j++) {
        //$array[$i][$j] = rand(0, 25);


        echo $array[$i][$j] . " ";

    }
    echo "<br>";

}
