<?php

namespace Projarr\Test\App;

use PHPUnit_Framework_TestCase;
use Projarr\App\SortBubble;

class DisplayTest {
    
    private $array = array();
    private $arrayHeight = 0;
    private $arrayLength = 0;

    public function setArrayDimensions()
    {
        $my = new SortBubble();
        $this->assertEquals(4, $my->arrayHeight(4));
        $this->assertEquals(4, $my->arrayLength(4));
        /**
         * 
         */
       // $this->arrayHeight = $arrayHeight;
       // $this->arrayLength = $arrayLength;
    }

    public function setArray($array)
    {
        $this->array = $array;
    }

    public function displayArray()
    {
        for ($i = 0; $i < $this->arrayHeight; $i++) {
            for ($j = 0; $j < $this->arrayLength; $j++) {
                //echo 'arr['.$i.']['.$j.'] = '.$this->array[$i][$j].' ';
                echo $this->array[$i][$j].' ';
            }
            echo '<br>';
        }
    }
}
