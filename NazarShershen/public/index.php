<?php

require '../app/arrayClass.php'; 

$a = new arrayClass();
$a->printArrayStraight();
echo "<hr>";
$a->transposeArray();
echo "<hr>";
$a->transposeArrayInversion();
echo "<hr>";