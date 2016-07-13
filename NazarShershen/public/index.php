<?php

require '../app/arrayClass.php'; 

$a = new arrayClass();

$a->printArray($a->array);
echo "<hr>";

$a->transposeArray();
echo "<hr>";

$a->transposeArrayInversion();
echo "<hr>";

//$a->spiralArray();
//echo "<hr>";

$snake = $a->snakeArray();
$a->printArray($snake);
echo "<hr>";