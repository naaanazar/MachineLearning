<?php

namespace ex\app\sorts;

class Vertically extends GeneralAbstractSort
{
    public function sort()
    {
        for($i = 0; $i <= $this->arraySize; $i++) {
            for($i2 = 0; $i2 <= $this->arraySize; $i2++) {
                $arraySort[$i2][$i] = $this->arrayForSorting[$i][$i2];
            }
        }
        return $arraySort;
    }
}
