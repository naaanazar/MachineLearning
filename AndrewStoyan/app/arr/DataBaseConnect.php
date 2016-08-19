<?php

namespace arrays\app\arr;

use mysqli;

/**
 * Description of DataBaseConnect
 *
 * @author dron
 */
class DataBaseConnect
{
    protected static $instance = null;
    protected static $mod = null;

    private function __construct()
    {

    }

    private function __clone()
    {

    }

    private function __wakeup()
    {

    }

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function doConnect()
    {
        return new mysqli('localhost', 'array', '12345', 'array');
    }

    public static function checkMod($type, $array, $connection)
    {
        if (is_null(self::$mod)) {
            self::doInsert($type, $array, $connection);
            self::$mod = 1;
        }
        self::doUpdate($type, $array, $connection);
    }

    public static function doInsert($type, $array, $connection)
    {
        $prepearedArray = serialize($array);
        $query = "INSERT INTO arrays VALUES (\"$type\", \"$prepearedArray\")";
        $connection->query($query);
    }

    public static function doUpdate($type, $array, $connection)
    {
        $prepearedArray = serialize($array);
        $query = "UPDATE arrays SET arr = \"$prepearedArray\" WHERE id = \"$type\"";
        $connection->query($query);
    }
}
