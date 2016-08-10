<?php

require_once '../app/auth/Auth.php';
$auth = new Auth;

if (isset($_POST["login"]) && isset($_POST["password"])) {
    $auth = new Auth;
    $auth->authorization($_POST["login"], $_POST["password"]);   
}

if (isset($_POST['logout'])){
    $auth->logout();
}
require_once 'view/login.php';
?>

