<?php

$k = 6;
$p = 7;


$j = $p * $k;





for ($i =1; $i<=$k; $i++) {

          foreach (range($i, $j, $k) as $number) {
              echo "$number ";

         }
    echo "<br>";

    $j = $j + 1;



}