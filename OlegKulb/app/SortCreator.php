<?php

namespace ex\app;

use ex\app\ArrayGeneration;

class SortCreator 
{
    private $size;

    public function __construct($size)
    {
        $this->size = $size;
    }

    public function getOriginalArray()
    {
       $arrayGeneration = new ArrayGeneration($this->size);
       $arrayOriginal = $arrayGeneration->generation();
       
       return $arrayOriginal;
    }

    public function getSort($name, $arrayOriginal)
    {
       $method = mb_strtolower($name);
       $sortClass = new SortingArrays($this->size, $arrayOriginal);
       $sort = $sortClass->$method();
        
       return $sort;
    }
}
