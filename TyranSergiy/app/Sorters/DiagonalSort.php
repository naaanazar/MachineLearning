<?php



namespace app\Sorter;

class DiagonalSort extends BasicSorter {
  
public function sort($inputArray) {

    

        $i = 0;
        $j = 0;
        $mainDiagonal = false;
         $sortedArray = array();  
            
            for($p = 0; $p < count($inputArray); $p++) {
              for($k = 0; $k < count($inputArray); $k++) {
            
               $sortedArray[$i][$j] = $inputArray[$p][$k];
             
               
               if($mainDiagonal == false){
                   
                if(($i==0) && ($j!=0) ){$i = ++$j; $j = 0;
                 if($i==count($inputArray)){$mainDiagonal= true; $i=count($inputArray)-1; $j=1; continue;}
              
                continue;}
                
                if(($i == 0) && ($j == 0)){$i++;continue;}
                
                if($i!=0){$i--;$j++;continue;} 
                
               }
               
               if($mainDiagonal== true){
                 
                   if($j!=count($inputArray)-1){$i--;$j++; continue;}
                   if($j==count($inputArray)-1){$j = ++$i; $i = count($inputArray)-1;  continue;}
                   
               }
                
                 
               
             
               
              }
            }
           
    return $sortedArray;
    
    
    
}


}