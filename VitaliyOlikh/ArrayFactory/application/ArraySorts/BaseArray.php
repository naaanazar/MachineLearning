<?php

namespace project\application\ArraySorts;

use project\application\ArrayDB;

abstract class BaseArray
{
    protected $array;

    protected $title = "Base Array";

    abstract public function sort();

    public function arrayFeel($number)
    {
        $counter = 1;
        for ($i = 0; $i < $number; $i++) {
            for ($j = 0; $j < $number; $j++) {
                $this->array[$i][$j] = $counter++;
            }
        }
        
        return $this->array;
    }

    public function display()
    {
        $serArray = serialize($this->array);

        $connDB = new ArrayDB();
        $conn = $connDB->connectDB();

        $sql = "SELECT type_array, data_array FROM Array "
                . "WHERE type_array = '$this->title'";

        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        if ($row['type_array'] == $this->title) {
            $array = unserialize($row['data_array']);

            echo "<table border='1'>";
            echo "<caption>" . $row[type_array] . "</caption>";

            foreach ($array as $value) {
                echo "<tr>";
                
                foreach($value as $var) {
                    echo "<td style='text-align: center; padding: 10px;'>";
                    echo "$var" . PHP_EOL;
                    echo "</td>";
                }

                echo "</tr>";
            }

            echo "</table>";
            
        } else {
            $sql2 = "INSERT INTO Array (type_array, data_array) "
                    . "VALUES ('$this->title', '$serArray')";
            
            if ($conn->query($sql2) === TRUE) {
                echo "New record created successfully" . "<br>";
            } else {
                echo "Error: " . $sql2 . "<br>" . $conn->error;
            }
        }
    }    
}
