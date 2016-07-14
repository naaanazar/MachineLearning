<?php

namespace project\application\ArraySorts;

class SpiralSorter extends BaseArray
{
    protected $title = "Spiral Array";

    public function sort()
    {
        $n = count($this->array);
        $i = 1;
        $p = $n / 2;
        for ($k = 1; $k <= $p; $k++) {
            for ($j = $k - 1; $j < $n - $k + 1; $j++) {
                $this->array[$k - 1][$j] = $i++;
            }
            
            for ($j = $k; $j < $n - $k + 1; $j++) {
                $this->array[$j][$n - $k] = $i++;
            }

            for ($j = $n - $k - 1; $j >= $k - 1; --$j) {
                $this->array[$n - $k][$j] = $i++;
            }

            for ($j = $n - $k - 1; $j >= $k; $j--) {
                $this->array[$j][$k - 1] = $i++;
            }
        }
        
        return $this->array;
    }
}
