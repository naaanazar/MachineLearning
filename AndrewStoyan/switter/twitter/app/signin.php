<?php

require_once __DIR__.'/../vendor/autoload.php';
use twitter\app\Twitter;

$user = new Twitter();
$user->SignIn($argv[1], $argv[2], $argv[3]);