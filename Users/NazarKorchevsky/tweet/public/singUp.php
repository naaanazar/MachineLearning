<?php
error_reporting(E_ALL); ini_set('display_errors', 1);



if (isset($_POST['confirm_password']) &&
    isset($_POST['user']) &&
    isset($_POST['password'])) {
        require '../app/auth/SingUp.php';
        $sing = new SingUP;
        $sing->reg($_POST['user'], $_POST['mail'], $_POST['password'], $_POST['confirm_password']);
    }


require_once 'view/singUp.html';
?>