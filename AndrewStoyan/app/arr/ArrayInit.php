<?php

namespace arrays\app;

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once __DIR__.'/../../vendor/autoload.php';

use arrays\app\ArrayFactory;
use arrays\app\arr\out\OutPut;

if (isset($_POST['number']) && isset($_POST['submit'])) {
    $number = $_POST['number'];
    $arrays = new ArrayFactory();
    $types = $arrays->GetTypes($number);

    foreach ($types as $type) {
        $array = $arrays->GetArray($type);
        $array->Feel();
        $array->Display();
        $array->File();
    }    
}

