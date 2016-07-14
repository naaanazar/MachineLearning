<?php

namespace project\application\ArraySorts;

class VerticalRevSorter extends BaseArray
{
    protected $title = "Vertical Reverse Sorter";

    public function sort()
    {
        $n = count($this->array);
        $counter = 1;

        for ($j = $n - 1; $j >= 0; $j--) {
            for ($i = $n - 1; $i >= 0; $i--) {
                $this->array[$i][$j] = $counter++;
            }
        }
        
        return $this->array;
    }

}
