<?php

namespace sa\app\DB;

use sa\app\DB\Database;

class DBArray
{
    public $str;
    
    
    public function insertArray($str)
    {
        $s = '';
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
        $sql = "SELECT array, date FROM array ORDER BY date DESC LIMIT 1";
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
