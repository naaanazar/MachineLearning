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


    public function __construct()
    {
        $this->db = Db::getInstance();
    }


    public function singUp()
    {

        $result = $this->db->query("INSERT INTO `twitter`(`Login`, `Email`, `Pass`) VALUES ('Dregan', 'example@gmail.com', 'password')");

        $this->user_id = $this->db->query("SELECT `Id` From `twitter` WHERE Login = 'Dregan'");



        return $this->user_id;
        //return $this->user_id->fetchAll(PDO::FETCH_ASSOC);
        //$downloadresult = $this->db->query("SELECT result FROM `arraysort` WHERE type = '$type';");
    }
}