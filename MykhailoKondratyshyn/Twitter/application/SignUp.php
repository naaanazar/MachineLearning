<?php

namespace dregan\application;

use dregan\database\Db;
use PDO;

/**
 * Created by PhpStorm.
 * User: dregan
 * Date: 11.07.16
 * Time: 23:45
 */
class SignUp
{



    public function __construct()
    {
        $this->db = Db::getInstance();
    }


    public function singUp($login, $email, $pass)
    {

        $this->db->query("INSERT INTO `twitter`(`Login`, `Email`, `Pass`) VALUES ('$login', '$email', '$pass')");

    }


    public function userId($login)
    {

        $result = $this->db->query("SELECT `Id` From `twitter` WHERE Login = '$login'");

        $user_id = $result->fetch(PDO::FETCH_ASSOC);
        return implode($user_id);
    }


}




