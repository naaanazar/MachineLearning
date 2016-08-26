<?php

namespace Projarr\App;

abstract class CreateArray {
    
    public $arrayHeight = 4;
    public $arrayLength = 4;
    protected $newArr;

    abstract function sortArr();

    public function __construct()
    {
        /**
         * Створюєм масив і заповнюєм його
         */
        for ($i = 0; $i < $this->arrayHeight; $i++) {
            for ($j = 0; $j < $this->arrayLength; $j++) {
                $this->newArr[$i][$j] = rand(10,99);
            }
        }
    }

    public function displayArray()
    {
        for ($i = 0; $i < $this->arrayHeight; $i++) {
            for ($j = 0; $j < $this->arrayLength; $j++) {
                //echo 'arr['.$i.']['.$j.'] = '.$this->array[$i][$j].' ';
                echo $this->newArr[$i][$j] . ' ';
            }
            echo '<br>';
        }
    }
}