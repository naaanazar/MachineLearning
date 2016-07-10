<?php

class CreateArray 
{      
    public function  crArray($height1, $width, $type){
        $k=1;       
        $array = [];       
        for ($i = 1; $i <= $height1; $i++){
            for ($j = 1; $j <= $width; $j++){
                if ($type == 'successively'){
                    $array[$i][$j] = $k++;  
                } elseif ($type == 'random'){ 
                    $array[$i][$j] = rand(RAND_MIN, RAND_MAX);
                }
            }
        }
    return $array;
    }
}