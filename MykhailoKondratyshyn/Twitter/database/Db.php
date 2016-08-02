<?php

namespace dregan\database;

use PDO;

class Db
{
    private static $db = null;

    public static function getInstance()
    {
        if (self::$db === null) {
            self::$db = new PDO('mysql:host=127.0.0.1;dbname=sort', 'dregan', 'supersuper');
        }

        return self::$db;
    }

    private function __construct()
    {

    }
    private function __clone()
    {

    }



}