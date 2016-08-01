<?php

error_reporting(E_ALL & ~E_NOTICE);
ini_set("display_errors", 1);

require __DIR__ . '/../vendor/autoload.php';
use arr\app\ArraysFactory;
use arr\app\twitter\User;


//include_once './htmlForAjax.html';

$a = new User();
$id = $a->signUp("Nazar", "example@gmail.com", "123");
echo "<br>$id";

