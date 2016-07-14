<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace arr\app\sorters;

/**
 *
 * @author Nazar
 */
abstract class BaseSort
{
    public $elementsQuantity = 5;
    public $array = array();
    
    public abstract function sortArray();

    public function __construct()
    {
        $cnt = 0;
        for ($i = 0; $i < $this->elementsQuantity; $i++) {
            for ($j = 0; $j < $this->elementsQuantity; $j++) {
                $cnt++;
                $this->array[$i][$j] = $cnt;
            }
        } 
    }

    public function convertToOneDimension($array)
    {
        $oneDimArray = array();
        foreach ($array as $row) {
            foreach ($row as $item) {
                array_push($oneDimArray, $item);
            }
        }

        array_unshift($oneDimArray, "");
        unset($oneDimArray[0]);

        return $oneDimArray;
    }
}
