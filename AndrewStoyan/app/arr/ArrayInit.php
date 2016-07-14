<?php

namespace arrays\app;

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once __DIR__.'/../../vendor/autoload.php';

use arrays\app\ArrayFactory;

if (isset($_POST['number']) && isset($_POST['submit'])) {
    $number = $_POST['number'];
    $array = new ArrayFactory();
    $arrays = $array->SetFactory();

    foreach ($arrays as $type) {
        $array = new $type($number);
        $array->Feel();
        $array->Display();
    }
}