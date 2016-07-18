<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace yu\app\sorters;

/**
 * Description of BaseSorterArray
 *
 * @author yurii
 */
abstract class BaseSorterArray {
    protected $array = array();
    protected $elementsQuantity = 0;

    abstract public function sort();

    public function setArray($array)
    {
        $this->array = $array;
    }

    public function setQuantity($quantity)
    {
        $this->elementsQuantity = $quantity;
    }
    

}
