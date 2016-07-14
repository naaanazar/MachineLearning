<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace yu\app\sorters;

use yu\app\sorters\BaseSorterArray;
/**
 * Description of TransposeArrayInversion
 *
 * @author yurii
 */
class TransposeArrayInversion extends BaseSorterArray
{
    public function sort()
    {
        $array_to_print = "";

        for ($i = $this->elementsQuantity - 1; $i >= 0; $i--) {
            for ($j = $this->elementsQuantity-1; $j >= 0; $j--) {
                $array_to_print .= $this->array[$j][$i]. "&nbsp;";

                if ($this->array[$j][$i] < 10) {
                    $array_to_print .= "&nbsp;&nbsp;";
                }
            }

            $array_to_print .= "</br>";
        }

        echo $array_to_print;
    }
}
