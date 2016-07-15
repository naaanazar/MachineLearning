<?php

require __DIR__ . '/../vendor/autoload.php';

use dregan\application\NewArray;
use dregan\application\VerticalArray;
use dregan\application\UnVerticalArray;
use dregan\application\MyClass;

$newArrayObject = new NewArray();

echo "<hr>";
$verticalArrayObject = new VerticalArray();
$verticalArrayObject->generateArray(5);

$verticalArrayObject->sortVerticalArray();

echo "<hr>";
$unVerticalArrayObject = new UnVerticalArray();
$unVerticalArrayObject->generateArray(5);
$unVerticalArrayObject->sortUnVerticalArray();
echo "<hr>";
$myClass = new MyClass();
//$factory = new dregan\application\ArrayFactory();
