<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace yu\app\sorters;

use yu\app\sorters\BaseSorterArray;


/**
 * Description of ArrayStraight
 *
 * @author yurii
 */
class ArrayHorizontal extends BaseSorterArray {
    public function sort() {
        $array_to_print = "";

        foreach ($this->array as $row) {
            foreach ($row as $item) {
                $array_to_print .=  $item. "&nbsp;";

                if ($item < 10) {
                    $array_to_print .= "&nbsp;&nbsp;";
                }
            }

            $array_to_print .= "</br>";
        }

        echo $array_to_print;
    }
}
