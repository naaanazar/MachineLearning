<?php

require_once __DIR__ . '/../vendor/autoload.php';

use twitter\app\Twitter;


if (isset($_POST['value1']) && $_POST['value1'] == "submit3") {
    $user = new Twitter;
    $user->getPosts(0);
}

