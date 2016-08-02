<?php

error_reporting(E_ALL & ~E_NOTICE);
ini_set("display_errors", 1);

require __DIR__ . '/../vendor/autoload.php';
use arr\app\ArraysFactory;
use arr\app\twitter\User;


//include_once './htmlForAjax.html';

$a = new User();
//$id = $a->signUp("Nazar4", "example@gmail.com", "123");




//$message = "fsagfasiugf;agsfsagfasu;gf";
//$a->tweet(3, $message);

//$p = $a->getPosts(3);
//
//echo "<pre>";
//print_r($p);
//echo "</pre>";

//$a->follow(1, 3);
//$a->follow(1, 10);
//$a->follow(1, 2);

//$a->unFollow(1, 3);

$z = $a->getFollowers(1);

echo "<pre>";
var_dump($z);
echo "</pre>";

