<?php

    namespace sa\app;
    
    use sa\app\ArraySort;

    class SortSpiral extends ArraySort
    {        
        public function sortArrayType($sort)
        {
            global $ar;
            global $n;
           
            $array=$this->sortArray($sort);   
            self::$sort_type1 = 'Spiral  ' . $sort;           
            $i = $j = 0;            
            $w = count($array);
            $right = $w - 1;
            $left = 0;
            $s = 0; 
            
            for ($k = 0; $k < $n * $w; ++$k) {
                $array[$i][$j] = $ar[$s++];
                
                if (($i == ($left + 1)) and ($j == $left)) { 
                    $right--;
                    $left++;
                } 
                
                if (($j == $right) and ($i < $right)) { 
                    $i++;
                    continue;
                } 
               
                if (($j < $right) and ($i == $left)) {
                    $j++; 
                    continue;
                } 
               
                if (($i == $right) and ($j > $left)) { 
                    $j--;
                    continue;
                } 
               
                if (($j == $left) and ($i > $left)) {
                    $i--; 
                    continue;} 
            };
            return $array;  
        }
    }