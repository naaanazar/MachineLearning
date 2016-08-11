<?php



//error_reporting(E_ALL & ~E_NOTICE);
ini_set("display_errors", 1);

error_reporting(E_ALL);

require __DIR__ . '/../vendor/autoload.php';

use arr\app\ArraysFactory;
use arr\app\twitter\User;
use arr\app\triada\Triada;
use arr\app\Sequence;
use arr\app\tree\Tree;
use arr\app\tree\Tree2;

//include_once './htmlForAjax.html';


$path = '/home/nazar/shared';
//$a = new Tree('/home/nazar/shared/');
//$tree = $a->buidTree();
//
//echo "<ul>$tree</ul>";

$a = new Tree2('/home/nazar/shared/');
$it = $a->createIterator();
$a->iterateDirectory($it);



$factorial = function($number) use(&$factorial) {

    $fact = 1;  

    if($number == 0) {
        return 1;
    }

    while($number > 1) {
        $fact *= $number--;
        $factorial($number);
    }

    return $fact;
};

//echo $factorial(5);