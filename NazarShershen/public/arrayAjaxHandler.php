<?php

namespace arr\app;
require __DIR__ . '/../vendor/autoload.php';
use arr\app\ArraysFactory;


$factory = new ArraysFactory();

if($_POST['type'] == 1) {

    $straightObj = $factory->getSorter("straightSort");
    $array = $straightObj->sortArray();
    $json = json_encode( array('array' => $array) ) ;
    echo $json;

} elseif($_POST['type'] == 2) {
    $vertObj = $factory->getSorter("verticalSort");
    $array = $vertObj->sortArray();
    $json = json_encode( array('array' => $array) ) ;
    echo $json;
}

if($_GET['type'] == 3) {
    $vertObj = $factory->getSorter("verticalSort");
    $vertObj->flag = true;
    $array = $vertObj->sortArray();
    $json = json_encode( array('array' => $array) ) ;
    echo $json;
}



