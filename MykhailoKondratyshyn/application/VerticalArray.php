<?php

namespace dregan\application;


class VerticalArray extends NewArray
{
    public function sortArray()
    {
        $arraySorted = array();

        for ($i = 0; $i <= count($this->arrayNew) - 1; $i++) {
            for ($j = 0; $j <= count($this->arrayNew) - 1; $j++) {
                $arraySorted[$j][$i] = $this->arrayNew[$i][$j];

            }
        }


        return $arraySorted;


    }

}