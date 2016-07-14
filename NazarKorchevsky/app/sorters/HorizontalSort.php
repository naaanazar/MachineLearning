<?php

namespace sa\app\sorters;

use \sa\app\sorters\BaseSort\BaseSort;

class HorizontalSort extends BaseSort
{

    public function sort()
    {
        $array = $this->sortArray($this->order, $this->array);
        self::$title = 'Horizontal  ' . $this->order;

        return $array;
    }

    public function addToFactoryArray()
    {
        return 'true';
    }
}
