<?php

namespace project\application\ArraySorts;


class SnakeSorter extends BaseArray
{
    protected $title = "SnakeSorter";

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
