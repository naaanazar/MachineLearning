<?php

namespace sa\app\sorters;

use \sa\app\sorters\BaseSort\BaseSort;

class VerticalSort extends BaseSort
{

    public function sort()
    {
        self::$title = 'Vertical  ' . $this->order;

        $array = $this->sortArray($this->order, $this->array);
        array_unshift($array, null);
        $array = call_user_func_array('array_map', $array);

        return $array;
    }

    public function addToFactoryArray()
    {
        return true;
    }
}
