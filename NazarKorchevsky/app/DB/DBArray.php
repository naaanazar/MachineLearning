<?php

namespace sa\app\DB;

use sa\app\DB\Database;

class DBArray
{
    public $str;    
    
    public function insertArray($str)
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();
        
        $str = htmlspecialchars(mysqli_real_escape_string($conn, $str));  
        
        $sql = "INSERT INTO array (array) VALUES ('$str')";
        $result = $conn->query($sql);             
    }
    
    public function selectArray() 
    {
        $out = '';
        
        $db = Database::getInstance();
        $mysqli = $db->getConnection();        
        $sql = "SELECT array, date FROM array ORDER BY date DESC LIMIT 5";
        $result = $mysqli->query($sql);        
        
        if ($result->num_rows > 0) {
            
            while($row = $result->fetch_assoc()) {
                $out .= '<i><b>' . $row['date'] . '</b></i><br>';
                $out .= $row['array'] . '<br>';
            }
        } else {
            echo "0 results";
        }
                       
        $out = htmlspecialchars_decode($out);
        
        return $out;
    }
}


/*
 * <?php

namespace sa\app\DB;

class DBArray
{
    public $str;
    
    public function  sql_connect()
    {
	
        require_once 'dbConfig.php';		
        $conn=$this->sql_conn();
        return $conn;
    }

    function sql_conn()
    {
        $conn = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
        mysqli_set_charset( $conn, 'utf8');
        
            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
        return $conn;
    }
    
    public function insertArray($str)
    {
        $conn = $this->sql_connect();
        
        $str = htmlspecialchars(mysqli_real_escape_string($conn, $str));
        
        $sql = "INSERT INTO array (array) VALUES ('$str')";
        
        if ($conn->query($sql) !== TRUE) {      
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
        $conn->close();
    }
    
    public function selectArray() 
    {
        $out = '';
        
        $conn = $this->sql_connect(); 
        
        $sql = "SELECT array, date FROM array ORDER BY date DESC LIMIT 5";        
        
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            
            while($row = $result->fetch_assoc()) {
                $out .= '<i><b>' . $row['date'] . '</b></i><br>';
                $out .= $row['array'] . '<br>';
            }
        } else {
            echo "0 results";
        }
        
        $conn->close(); 
        
        $out = htmlspecialchars_decode($out);
        
        return $out;
    }
}
 */