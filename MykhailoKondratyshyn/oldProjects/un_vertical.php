<?php

$k = 5;
$p = 5;


$j = $p * $k;





for ($i = $p; $i>=1; $i--) {

    foreach (array_reverse(range($i, $j, $k)) as $number) {
        echo "$number ";

    }
    echo "<br>";

    $j = $j - 1;



}