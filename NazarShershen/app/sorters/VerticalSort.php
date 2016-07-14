<?php

namespace arr\app\sorters;

/**
 * Description of VerticalSort
 *
 * @author Nazar
 */
class VerticalSort extends BaseSort
{
    public $flag = false;

    public function sortArray()
    {
        $array_to_print = "";

        if (!$this->flag) {
            for ($i = 0; $i < $this->elementsQuantity; $i++) {
                for ($j = 0; $j < $this->elementsQuantity; $j++) {
                    $array_to_print .= $this->array[$j][$i]. "&nbsp;";
                    if ($this->array[$j][$i] < 10)
                    {
                        $array_to_print .= "&nbsp;&nbsp;";
                    }
                }
                $array_to_print .= "</br>";
            }
        } else {
            for ($i = $this->elementsQuantity-1; $i >= 0; $i--) {
                for ($j = $this->elementsQuantity-1; $j >= 0; $j--) {
                    $array_to_print .= $this->array[$j][$i]. "&nbsp;";
                    if ($this->array[$j][$i] < 10)
                    {
                        $array_to_print .= "&nbsp;&nbsp;";
                    }
                }
                $array_to_print .= "</br>";
            }
        }
        
        echo $array_to_print;
    }
}
