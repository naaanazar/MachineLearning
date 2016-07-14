<?php

namespace project\application\ArraySorts;

class StandartSorter extends BaseArray
{
    protected $title = 'Standart Array';

    public function sort()
    {
        return $this->array;
    }

}
