<?php

namespace sa\app\sorters;

use \sa\app\sorters\BaseSort\BaseSort;

class HorizontalSort extends BaseSort
{

    public function sort()
    {
        self::$title = 'Horizontal  ' . $this->order;

        $array = $this->sortArray($this->order, $this->array);
        return $array;
    }

    public function addToFactoryArray()
    {
        return true;
    }
}
