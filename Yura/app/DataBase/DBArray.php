<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace yu\app\DataBase;

use yu\app\DataBase\DBGW;
/**
 * Description of DBArray
 *
 * @author yurii
 */
class DBArray
{
    public $str;

    public function insertArray($str)
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $str = htmlspecialchars(mysqli_real_escape_string($conn, $str));

        $sql = "INSERT INTO mytable (name) VALUES ('name')";
        $result = $conn->query($sql);
    }
        
}

