<?php

namespace liw\app;

class VerticalSortClass extends BaseSort
{
    public $flag = false;
    private $elementsQuantity;

    public function sortArr()
    {
        if (!$this->flag) {
            for ($i = 0; $i < 5; $i++) {
                for ($j = 0; $j < 5; $j++) {
                    $this->sortedArr[$i][$j] = $this->arr[$j][$i];
                }
            }
        } else {
            $this->sortedArr = array();
            $row = 0;
            
            for ($i = 4; $i >= 0; $i--) {                
                for ($j = 4; $j >= 0; $j--) {                    
                    $this->sortedArr[$row][] = $this->arr[$j][$i];
                }
                $row++;
            }
        }
        
        return $this->sortedArr;
    }
}
