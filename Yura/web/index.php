<?php
echo"I`m working.GO AWAY".'<br>';
require '../app/arrayClass.php'; 



$a = new arrayClass();
$a->printArrayStraight();
$a->transposeArray();
$a->transposeArrayInversion();
$a->testArray();

