<?php

namespace sa\app\sorters;

use \sa\app\sorters\BaseSort\BaseSort;

class SnakesSort extends BaseSort
{

    public function sort()
    {
        $array = $this->sortArray($this->order, $this->array);
        self::$title = 'Zipper  ' . $this->order;

        if ($this->order == 'ASC') {
            $f = 1;
        } elseif ($this->order == 'DESC') {
            $f = 2;
        }

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $tmp = $array[$key];
                if (($f % 2) == 0) {
                    $array[$key] = array_reverse($tmp);
                }
                $f++;
            }
        }
        return $array;
    }

    public function addToFactoryArray()
    {
        return 'true';
    }
}
