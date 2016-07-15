<?php



namespace app\Sorter;

class SpiralSort {
   
     
     public static function sort($inputArray,$type = 1) {
       
            
        $i = 0;
        $j = 0;
        $w = count($inputArray)-1;
        $l = 0;
         $sortedArray = array();     
        
            
            for($p = 0; $p < count($inputArray); $p++) {
              for($k = 0; $k < count($inputArray); $k++) {
                   
                $sortedArray[$i][$j] = $inputArray[$p][$k];
                  
                   
    if (($i==($l+1))&&($j==$l))
        {$w--;$l++;} 
        
	if (($j==$w)&&($i<$w)) 
        {$i++;continue;} 
    
	if (($j<$w)&&($i==$l))
        {$j++;continue;} 
        
	if (($i==$w)&&($j>$l))
        {$j--;continue;} 
        
	if (($j==$l)&&($i>$l))
        {$i--;continue;}
     
                }
            }
            return $sortedArray;
    
         
         
       
     }


}