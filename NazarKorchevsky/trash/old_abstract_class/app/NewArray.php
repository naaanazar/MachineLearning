<?php

    namespace sa\app;

    class NewArray 
    {  
        public $array=array(
            array (1, 2, 3, 4, 5),
            array (6, 7, 8, 9, 10),
            array (11, 12, 13, 14, 151),
            array (16, 17, 18, 19, 201),
            array  (21, 22, 23, 24, 25)
        );
        public $randMin = 1;
        public $randMax = 100;
        
        public function  crArray($height1, $width, $type){
            $k=1;       
            $this->array = []; 
            
            for ($i = 1; $i <= $height1; $i++){
                
                for ($j = 1; $j <= $width; $j++){
                    
                    if ($type == 'successively'){
                        $array[$i][$j] = $k++;  
                    } elseif ($type == 'random'){ 
                        $array[$i][$j] = rand($this->randMin, $this->randMax);
                    }                    
                }                
            }            
        return $array;
        }
    }