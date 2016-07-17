<?php

namespace liw\app;

abstract class BaseSort
{
    protected $sortedArr = array();
    
    protected $arr = array( 
        array(1, 2, 3, 4, 5 ), 
        array(6, 7, 8, 9, 10), 
        array(11, 12, 13, 14, 15),
        array(16, 17, 18, 19, 20),
        array(21, 22, 23, 24, 25)
    ); 
    
    public abstract function sortArr();
    
    public function displayArray()
    {
        foreach ($this->sortedArr as $row) {
            foreach ($row as $item) {
                echo $item . "&nbsp;&nbsp;";
                if($item < 10) {
                    echo "&nbsp;&nbsp;";
                }
            }
            echo "</br>";
        }
        echo "<hr>";
    }
}
