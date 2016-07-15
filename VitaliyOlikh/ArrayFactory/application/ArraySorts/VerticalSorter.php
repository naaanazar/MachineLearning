<?php

namespace Project\Application\ArraySorts;

class VerticalSorter extends BaseArray
{
    protected $title = "Vertical Sort";

    public function sort()
    {
        $n = count($this->array);
        $counter = 1;

        for ($j = 0; $j < $n; $j++) {
            for ($i = 0; $i < $n; $i++) {
                $this->array[$i][$j] = $counter++;
            }
        }

        return $this->array;
    }

}
