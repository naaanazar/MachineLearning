<?php

class GenerationArray {
    
    function makeArray($size) {
        for($i = 0, $value = 1; $i <= $size; $i++) {
            for($i2 = 0; $i2 <=$size; $i2++) {
                $arrList[$i][$i2] = $value++;
            }
        } 
        return $arrList;
    }
    
}
