<?php

namespace Project\Application\ArraySorts;

class SpiralRevSorter extends BaseArray
{
    protected $title = "Spiral Reverse Sort";

    public function sort()
    {
        $count = count($this->array);
        $counter = $count * $count;
        $i = $j = 0;
        $right = 5 - 1;
        $left = 0;

        for ($n = 0; $n < $count * $count; ++$n) {

            $this->array[$i][$j] = $counter--;

            if (($i == ($left + 1)) && ($j == $left)) {
                $right--;
                $left++;
            }
            if (($j == $right) && ($i < $right)) {
                $i++;
                continue;
            }
            if (($j < $right) && ($i == $left)) {
                $j++;
                continue;
            }
            if (($i == $right) && ($j > $left)) {
                $j--;
                continue;
            }
            if (($j == $left) && ($i > $left)) {
                $i--;
                continue;
            }
        }

        return $this->array;
    }

}
