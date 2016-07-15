<?php

namespace Project\Application\ArraySorts;

class SnakeSorter extends BaseArray
{
    protected $title = "Snake Sort";

    public function sort()
    {
        foreach ($this->array as $key => $value) {
            if(($key % 2) != 0) {
                $this->array[$key] = array_reverse($this->array[$key]);
            }
        }

        return $this->array;
    }

}
