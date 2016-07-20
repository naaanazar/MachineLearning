<?php


class Db
{
    private static $_db = null;

    public static function getInstance()
    {
        if (self::$_db === null) {
            self::$_db = new PDO('mysql:host=localhost;dbname=test\', 'dregan\', 'supersuper\'');
            }
            return self::$_db;
    }



    private function __construct()
    {

    }
    private function __clone()
    {

    }



}