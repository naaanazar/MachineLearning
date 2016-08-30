<?php

namespace app\Figure;

class Matrix {

    private $size;
    private $array;

    public function getArray(){
    return $this->array;
}
public function setArray($array){
    $this->array = $array;
}


    public function __construct($SIZE = 5) {

        $this->size = $SIZE;

        $firstValue = 1;

        for ($i = 0; $i < $this->size; $i++) {
            for ($j = 0; $j < $this->size; $j++) {
                $this->array[$i][$j] = $firstValue++;
            }
        }
        
    }

   
    
    
    public function diff($firstArr,$secondArr){
        
    $firstArr= call_user_func_array('array_merge', $firstArr);
    $secondArr = call_user_func_array('array_merge', $secondArr);
        
    $diffrences = array_diff($firstArr, $secondArr);
   
    return $diffrences;
        
        
    }

}
