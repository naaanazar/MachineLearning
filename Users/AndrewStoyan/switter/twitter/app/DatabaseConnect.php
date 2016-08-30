<?php

namespace twitter\app;
use mysqli;
/**
 * Description of DatabaseConnect
 *
 * @author dron
 */
class DatabaseConnect
{
    protected static $instance = null;

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
        return new mysqli('localhost', 'twitter', 'supersuper', 'twitter');
    }
}
