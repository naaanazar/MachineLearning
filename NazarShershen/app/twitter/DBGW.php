<?php

namespace arr\app\twitter;

use PDO;

/**
 * Description of DBGW
 *
 * @author Nazar
 */
class DBGW
{
    private static $conn;

    private function __construct()
    {
        $servername = "localhost";
        $dbname = "twitter";
        $username = "twitter_user";
        $password = "377482433_!";

        try {

            static::$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            static::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch(PDOException $e) {

            echo "Connection failed: " . $e->getMessage();
            
        }
    }

    public static function getConnection()
    {
        if (null === static::$conn) {

            new DBGW();
            
        }

        return self::$conn;
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }
}

