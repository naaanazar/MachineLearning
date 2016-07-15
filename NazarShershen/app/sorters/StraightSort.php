<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace arr\app\sorters;

/**
 * Description of StraightSort
 *
 * @author Nazar
 */
class StraightSort extends BaseSort
{
    public function sortArray()
    {
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
