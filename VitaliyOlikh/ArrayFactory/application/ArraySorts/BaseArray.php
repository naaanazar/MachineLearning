<?php

namespace project\application\ArraySorts;

abstract class BaseArray
{
    protected $array;

    protected $title = "Base Array";

    abstract public function sort();

    public function ArrayFeel($number)
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
        echo "<table border='1'>";
        echo "<caption>" . $this->title . "</caption>";

        foreach ($this->array as $value) {
            echo "<tr>";
            foreach($value as $var) {
                echo "<td style='text-align: center; padding: 10px;'>";
                echo "$var" . PHP_EOL;
                echo "</td>";
            }
            
            echo "</tr>";
        }

        echo "</table>";
    }    
}
