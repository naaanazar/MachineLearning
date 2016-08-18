<?php

namespace sa\app\sorters\BaseSort;

use sa\app\NewArray;

abstract class BaseSort
{

    public $array;
    public $order = 'ASC';    
    static public $title;

    public function __construct()
    {
        $this->array = NewArray::$array;
    }

    abstract public function sort();

    abstract public function addToFactoryArray();

    public function setOrder($sort)
    {
        if ($sort !== 'ASC') {
            $this->order = 'DESC';
        }
    }

    public function sortArray()
    {
        global $ar;
        global $n;

        $ar = [];
        $n = max(array_map('count', $this->array));        

        foreach ($this->array as $j => $value) {
            $ar = array_merge($ar, $value);
        }

        if ($this->order == 'DESC') {
            rsort($ar);
        } elseif ($this->order == 'ASC') {
            sort($ar);
        }

        $sort_array = array_chunk($ar, $n);

        return $sort_array;
    }
}
