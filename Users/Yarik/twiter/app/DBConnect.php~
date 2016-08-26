<?php

namespace Projarr\App;

use PDO;

class DBConnect {

    private static $conn;

    public function __construct()
    {
        $servername = "127.0.0.1";
        $username = "root";
        $password = "password";
        $dbname="twiter";

        try {
            static::$conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
            static::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public static function dbConnect()
    {
        if (null === static::$conn) {
            new DBConnect();
        }
        return self::$conn;
    }
}
