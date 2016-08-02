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

        if (!$this->flag) {
            for ($i = 0; $i < $this->elementsQuantity; $i++) {
                for ($j = 0; $j < $this->elementsQuantity; $j++) {
                    $this->sortedArray[$i][$j] = $this->array[$j][$i];
                }
            }
        } else {
            $this->sortedArray = array();
            $row = 0;
            
            for ($i = $this->elementsQuantity-1; $i >= 0; $i--) {                
                for ($j = $this->elementsQuantity-1; $j >= 0; $j--) {                    
                    $this->sortedArray[$row][] = $this->array[$j][$i];
                }
                $row++;
            }
        }
        
        return $this->sortedArray;
    }
}