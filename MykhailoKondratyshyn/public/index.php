<?php


//require "../classes/NewArray.php";
require "../classes/HorisontalArray.php";
require "../classes/VerticalArray.php";
require "../classes/UnVerticalArray.php";
require "../classes/SpiralArray.php";

 $horisontalArrayObject = new HorisontalArray();
echo "<hr>";
 $varticalArrayObject = new VerticalArray();
echo "<hr>";
 $unVerticalArrayObject = new UnVerticalArray();
echo "<hr>";
$spiralArrayObject = new SpiralArray(5);
echo "<hr>";


//var_dump($horisontalArrayObject->horisontalArray());


//$firstArray = range(0, 25);
//
//foreach ($firstArray as $number) {
//    echo $number;
//}

//print_r($horisontalArrayObject);

//$a = array(
//    range(1, 5),
//    range(6, 10),
//
//);
//
//
//print_r($a);
//
