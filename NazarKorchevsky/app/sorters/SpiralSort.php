<?php

namespace sa\app\sorters;

use \sa\app\sorters\BaseSort\BaseSort;

class SpiralSort extends BaseSort {

    public function sort() {

        global $ar;
        global $n;

        $array = $this->sortArray($this->order, $this->array);
        self::$title = 'Spiral  ' . $this->order;
        $i = $j = 0;
        $w = count($array);
        $right = $w - 1;
        $left = 0;
        $s = 0;

        for ($k = 0; $k < $n * $w; ++$k) {
            $array[$i][$j] = $ar[$s++];

            if (($i == ($left + 1)) and ( $j == $left)) {
                $right--;
                $left++;
            }

            if (($j == $right) and ( $i < $right)) {
                $i++;
                continue;
            }

            if (($j < $right) and ( $i == $left)) {
                $j++;
                continue;
            }

            if (($i == $right) and ( $j > $left)) {
                $j--;
                continue;
            }

            if (($j == $left) and ( $i > $left)) {
                $i--;
                continue;
            }
        };
        return $array;
    }

    public function addToFactoryArray() {
        return 'true';
    }

}
