<?php

namespace ex\app\Database;

use PDO;

class DBGW
{
    private static $instance;
    private static $pdo;


    private function __construct()
    {
//                            'exbers',
//                    'firstuserfordatabase',
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

    public static function query($type1, $array1)
    {
        $stmt = self::$pdo->prepare("INSERT INTO arrays (type, array) VALUES (:type, :array)");
        
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':array', $array);

        $type = $type1;
        $array = $array1;
        $stmt->execute();
    }

}
