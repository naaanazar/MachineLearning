<?php

namespace ex\app\Database;

use PDO;

class DBGW
{
    private static $instance;
    private static $pdo;


    private function __construct()
    {
        try {
            self::$instance = new PDO('mysql:host=localhost;dbname=CrowdinSpace',
                    'exbers',
                    'firstuserfordatabase',
                    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            self::$pdo = self::$instance;
        } catch (Exception $exc) {
            die("Failed to connect" . $e->getMessage());
        }
    }

    public static function getInstance()
    {
        if ( empty(self::$instance) ) {
            echo 'instanceble';
            self::$instance = new DBGW();
        }
        
        return self::$instance;
    }

    public static function query($sql)
    {
        self::$pdo->beginTransaction();
        self::$pdo->exec("insert into arrays (type, array) values ('typeArray1', 'ARRAY1')");
        self::$pdo->commit();

    }

}
