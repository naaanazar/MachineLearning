<?php

require __DIR__ . '/../vendor/autoload.php';

use dregan\application\SignUp;
use dregan\application\Methods;


$login = "NickName";
$email = "example@gmail.com";
$pass = "Password";
$message = "Test Message";

$echo = new SignUp();
$echo->singUp($login, $email, $pass);
$us_id = $echo->userId($login);


$echho = new Methods();
$echho->tweet($us_id, $message);
$echho->getPosts($us_id);
$echho->follow($us_id, $us_id);
//$echho->unFollow($us_id);
$echho->getFollowers($us_id);