<?php


require_once __DIR__.'/../vendor/autoload.php';
use twitter\app\Twitter;

$user = new Twitter();
$user->getPosts($argv[1]);
