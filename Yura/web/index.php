<?php
echo"I`m working.GO AWAY".'<br>';
require '../app/arrayClass.php'; 
$a = new arrayClass();
$a->printArrayStraight();
echo "<hr>";
$a->transposeArray();
echo "<hr>";
$a->transposeArrayInversion();
echo "<hr>";
$a->ArraySnake();
echo "<hr>";