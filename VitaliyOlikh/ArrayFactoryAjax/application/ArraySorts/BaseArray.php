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

    public function displayDB()
    {
        $serArray = serialize($this->array);

        $connDB = new ArrayDB();
        $conn = $connDB->connectDB();

        $sql = "SELECT type_array, data_array FROM Array "
                . "WHERE type_array = '$this->title'";

        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        if ($row['type_array'] == $this->title && $row['data_array'] == $serArray) {
            $array = unserialize($row['data_array']);

            $file = $this->title . '.json';
            
            file_put_contents('js/json/' . $file, json_encode($array, TRUE));        
            
        } elseif($row['type_array'] == $this->title && $row['data_array'] !== $serArray) {
            $sql2 = "UPDATE Array SET data_array='$serArray' WHERE type_array='$this->title'";

            if ($conn->query($sql2) === TRUE) {
                echo "New record created successfully" . "<br>";
            } else {
                echo "Error: " . $sql2 . "<br>" . $conn->error;
            }

        } else {
            $sql3 = "INSERT INTO Array (type_array, data_array) "
                    . "VALUES ('$this->title', '$serArray')";
            
            if ($conn->query($sql3) === TRUE) {
                echo "New record created successfully" . "<br>";
            } else {
                echo "Error: " . $sql3 . "<br>" . $conn->error;
            }
        }
    }    
}
