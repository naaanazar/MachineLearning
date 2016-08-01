<?php

namespace dregan\application;

use dregan\database\Db;

/**
 * Created by PhpStorm.
 * User: dregan
 * Date: 11.07.16
 * Time: 23:45
 */
class Methods extends SignUp
{
    public function tweet()
    {
        $user_id = $this->singUp();

var_dump($user_id);
        $resul = $this->db->query("INSERT INTO `twitter_message`(`User_id`, `message`) VALUES ('$user_id', 'TextMessage1')");


        //echo $this->db->query("SELECT `message` From `twitter` WHERE Login = 'Dregan'");
    }

}