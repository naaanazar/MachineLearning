<?php

namespace dregan\application;

/**
 * Created by PhpStorm.
 * User: dregan
 * Date: 11.07.16
 * Time: 23:14
 */
class NewArray
{
    protected $arrayNew;

    public function generateArray($size)
    {
        $z = 1;
        for ($i = 0; $i <= $size - 1; $i++) {
            for ($j = 0; $j <= $size - 1; $j++) {
                $this->arrayNew[$i][$j] = $z++;
            }
        }
        return $size;

    }
}