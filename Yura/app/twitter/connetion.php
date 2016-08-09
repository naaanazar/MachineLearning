<?php
namespace liw\app\twitter;
use PDO;
class Connection
{
    private static $conn;
    private function __construct()
    {
        $servername = "localhost";
        $dbname = "Twitter";
        $username = "fidelite";
        $password = "supersuper";
        try {
            static::$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            static::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Failed to connect to MySQL: " . $e->getMessage();
        }
    }
    public static function getConnection()
    {
        if (null === static::$conn) {
            new Connection();
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

