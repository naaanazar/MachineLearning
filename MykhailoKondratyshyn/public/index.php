<?php


require "../classes/NewArray.php";
//require "../classes/HorisontalArray.php";
require "../classes/VerticalArray.php";
require "../classes/UnVerticalArray.php";
//require "../classes/SpiralArray.php";
require "../classes/Factory.php";


//$newArrayObject = new NewArray();

echo "<hr>";
$verticalArrayObject = new VerticalArray();
$verticalArrayObject->generateArray(5);

$verticalArrayObject->sortVerticalArray();

echo "<hr>";
$unVerticalArrayObject = new UnVerticalArray();
$unVerticalArrayObject->generateArray(5);
$unVerticalArrayObject->sortUnVerticalArray();
echo "<hr>";




