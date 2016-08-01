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

    protected $user_id;
    protected $login = "Dreggan";
    protected $email = "example@gmail.com";

    public function __construct()
    {
        $this->db = Db::getInstance();
    }


    public function singUp()
    {
        $login = $this->login;
        $email = $this->email;
        $this->db->query("INSERT INTO `twitter`(`Login`, `Email`, `Pass`) VALUES ('$login', '$email', 'password')");

    }


    public function userId()
    {
        $login = $this->login;
        $result = $this->db->query("SELECT `Id` From `twitter` WHERE Login = '$login'");

        $user_id = $result->fetch(PDO::FETCH_ASSOC);
        return implode($user_id);
    }


}




