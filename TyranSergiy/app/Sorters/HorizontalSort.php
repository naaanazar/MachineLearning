<?php

namespace app\Sorter;

class HorizontalSort extends BasicSorter{
     
     
    
     

     public function sort($inputArray,$type = 1) {
         
         switch ($type){
         case 1:
         $sortedMatrix = array();
        
        for( $i = 0 ; $i < count($inputArray); $i++){
        for( $j = 0, $k = count($inputArray)-1; $j < count($inputArray); $j++, $k-- ){
            
             $sortedMatrix[$j][$i] = $inputArray[$i][$k];
          
        }
        }
        
        return $sortedMatrix;
        break;
        
    case 2:
                
           $sortedMatrix = array();
        
        for( $i = 0 ; $i < count($inputArray); $i++){
        for( $j = 0; $j < count($inputArray); $j++){
            
             $sortedMatrix[$j][$i] = $inputArray[$i][$j];
          
        }
        }
        
        return $sortedMatrix;
        
        
        
        break;
         }
     }
     
     
 }