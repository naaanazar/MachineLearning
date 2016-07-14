<?php


$k = 6;

$j = 6;
$q = 1;

for ($i =1; $i<=$k; $i++) {

    foreach (range($q, $j) as $number) {
        echo "$number ";
    }
    $q = $q + $k;
    $j = $j + $k;

    echo "<br>";

}