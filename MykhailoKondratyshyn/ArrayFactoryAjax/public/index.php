<?php

require __DIR__ . '/../vendor/autoload.php';

use dregan\application\NewArray;
use dregan\application\VerticalArray;
use dregan\application\UnVerticalArray;
use dregan\application\MyClass;
use dregan\application\ArrayFactory;
use \dregan\application\HorisontalArray;

//echo "<hr>";
//$verticalArrayObject = new VerticalArray(5);
//
//$verticalArrayObject->echoArray();
//
//echo "<hr>";
//$unVerticalArrayObject = new UnVerticalArray(5);
//$unVerticalArrayObject->echoArray();
//echo "<hr>";
////$myClass = new MyClass();
////$factory = new dregan\application\ArrayFactory();
//
//$horisontalArray = new HorisontalArray(5);
//$horisontalArray->echoArray();

$factory = new ArrayFactory();
//foreach ($factory->getTypes() as $type) {
//    $factory->getArray($type, 5)->echoArray();
// //   $factory->getArray($type, 5)->goMysql($type);
//}

$factory->getArray($_POST['name'], 5)->echoArray();