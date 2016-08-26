<?php

namespace Projarr\App;

use Projarr\App\DBConnect;
use PDO;

class SingUp {

    public function __construct()
    {
        $this->db = DBConnect::dbConnect();
    }

    public function singUp($login, $email, $password)
    {
        $this->db->query("INSERT INTO `user` (`login`, `email`, `password`) VALUES ('$login', '$email', '$password')");
    }

    public function getUser($login)
    {
        $request = $this->db->query("SELECT `id_user` FROM `user` WHERE `login` = '$login'");
        $userId = $request->fetch(PDO::FETCH_ASSOC);
//        echo '<br /><br />User login - '.$login.' id = ';
//        print_r($userId);
        return implode($userId);
    }
}
