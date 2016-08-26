<?php

use Projarr\App\DBConnect;
use Projarr\App\SingUp;
use Projarr\App\Tweet;
use Projarr\App\Follow;

require __DIR__ . '/../vendor/autoload.php';

$login = 'Ivan' . rand(1, 10000);
$email = 'Ivan'.rand(1, 10000).'@google.com';
$password = '1q2w#E';
$massage = 'It is your new message!' . rand(1, 10000);
$userId1 = rand(1, 25);
$userId2 = rand(25, 50);
$idFollow = rand(1, 50);

$connect = new DBConnect();
$connect->dbconnect();

$singup = new SingUp();
$singup->singUp($login, $email, $password);
$userId = $singup->getUser($login);

$tweet = new Tweet();
$tweet->tweet($massage, $userId);
$tweet->getPost($userId);

$follow = new Follow();
$follow->follow($userId1, $userId2);
$follow->getFollowers($userId1);
$follow->unfollow($userId1, $userId2);
//$follow->unfollow($userId1, $userId2);
//$follow->unfollow($idFollow);
//echo '<br />_______________________________<br />';
$follow->getFollowers($userId1);
