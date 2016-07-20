<?php
namespace yu\app\DataBase;

use mysqli;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DBGW
 *
 * @author yurii
 */
class DBGW {
    private $_mysqli,
            $_query,
            $_result = array(),
            $_count = 0;

    public static $instance;

    public static function getInstance() {
        if(!isset(self::$instance)){
            self::$instance = new DBGW();
        }
        return self::$instance;
    }

    public function __construct() {
        $this->_mysqli = new mysqli('localhost', 'Fidelite', 'yurayura123', 'singleton');
        if ($this->_mysqli->connect_error) {
            die($this->_mysqli->connect_error);
        }

    }

        public function query($sql){
                if($this->_query == $this->_mysqli->query($sql))  {
            /* @var $row type */
            while ($row = $this->_query->fetch_object()){
                        $this->_result[] = $row;
                    }
                    $this->_count = $this->query->num_rows;
                }
                return $this;
        }
        public function results() {
            return $this->_result;
        }
        public function count(){
            return $this->_count;
        }
}
