<?php

namespace Projarr\Test\App;

class CreateArrayTest {
    
    public $arrayHeight = 4;
    public $arrayLength = 4;
    public $array = array();
    
    public function createArray()
    {
        /**
         * Створюєм масив і заповнюєм його
         */
        for ($i = 0; $i < $this->arrayHeight; $i++) {
            for ($j = 0; $j < $this->arrayLength; $j++) {
                $this->array[$i][$j] = rand(0,100);
            }
        }
    }
}