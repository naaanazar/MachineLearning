<?php

namespace project\application\ArraySorts;

class StandartSorter extends BaseArray
{
    protected $title = 'Standart Sort';

    public function sort()
    {
        return $this->array;
    }

}
