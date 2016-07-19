<?php

namespace ex\app\sorts;

class Snake extends GeneralAbstractSort
{
    protected function sort()
    {
        $counter = 1;

        foreach($this->arrayForSorting as $key1 => $arr1) {
            $coup = $this->arraySize;

            foreach($arr1 as $key2 => $arr2) {
                if($counter % 2) {
                    $arraySort[$key1][$key2] = $this->arrayForSorting[$key1][$key2];
                } else {
                    $arraySort[$key1][$coup] = $this->arrayForSorting[$key1][$key2];
                    $coup--;
                }
            }

            $counter++;
        }

        return $arraySort;
    }

}
