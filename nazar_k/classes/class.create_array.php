<?php

class CreateArray 
{   
   
    public function  crArray($height1, $width){
        $k=1;       
        $array = [];       
        for ($i = 1; $i <= $height1; $i++){
            for ($j = 1; $j <= $width; $j++){
                $array[$i][$j] = $k++;  
            }
        }
    return $array;
    }
}