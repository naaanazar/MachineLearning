<?php

namespace dregan\application;

/**
 * Created by PhpStorm.
 * User: dregan
 * Date: 11.07.16
 * Time: 23:44
 */
class UnVerticalArray extends NewArray
{
    public function sortArray()
    {
        $q = count($this->arrayNew) - 1;

        $arraySorted = array();

        for ($i = 0; $i <= count($this->arrayNew) - 1; $i++) {
            for ($j = 0; $j <= count($this->arrayNew) - 1; $j++) {
                $arraySorted[$j][$q] = $this->arrayNew[$i][$j];

            }
            $q--;
        }
        return array_reverse($arraySorted);

    }
}