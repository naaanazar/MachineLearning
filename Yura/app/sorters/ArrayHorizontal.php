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
        
        return "1&nbsp;&nbsp;2&nbsp;&nbsp;3&nbsp;&nbsp;4&nbsp;&nbsp;5&nbsp;&nbsp;</br>6&nbsp;&nbsp;7&nbsp;&nbsp;8&nbsp;&nbsp;9&nbsp;&nbsp;10&nbsp;</br>11&nbsp;12&nbsp;13&nbsp;14&nbsp;15&nbsp;</br>16&nbsp;17&nbsp;18&nbsp;19&nbsp;20&nbsp;</br>21&nbsp;22&nbsp;23&nbsp;24&nbsp;25&nbsp;</br>";
    }
}