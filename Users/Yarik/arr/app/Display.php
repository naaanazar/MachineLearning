<?php

namespace Projarr\App;

class Display {
    
    private $array = array();
    private $arrayHeight = 0;
    private $arrayLength = 0;

    public function setArrayDimensions($arrayHeight, $arrayLength)
    {
        /**
         * 
         */
        $this->arrayHeight = $arrayHeight;
        $this->arrayLength = $arrayLength;
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
