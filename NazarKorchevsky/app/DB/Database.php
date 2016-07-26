<?php

namespace sa\app\DB;

class Database 
{
	private $conn;
	private static $_instance;
	private $host = "localhost";
	private $username = "naaa";
	private $password = "98465703";
	private $database = "array";
	
	public static function getInstance() {
            if(!self::$_instance) { // If no instance then make one
                self::$_instance = new self();
            }
            return self::$_instance;
	}

	private function __construct() {
            $this->conn = mysqli_connect($this->host, $this->username, 
            $this->password, $this->database);
            //mysqli_set_charset( $this->conn, 'utf8');

            if(mysqli_connect_error()) {
                trigger_error("Failed to conencto to MySQL: " . mysql_connect_error(), E_USER_ERROR);
            }
	}
	
	private function __clone() { }

	public function getConnection() {
		return $this->conn;
	}
}