<?php

namespace app\Figure;
class Matrix{
    
    private $size;
    private $array;
    
    
    public function __construct($SIZE = 5) {
       
      $this->size = $SIZE;
      
        $firstValue = 1;
        
        for( $i = 0; $i < $this->size; $i++ ){
        for( $j = 0; $j < $this->size; $j++ ){
        $this->array[$i][$j]= $firstValue++;
        }
        }
     
    }
    
    public function outHTML(){
        echo '<table>';
        for( $i = 0; $i < $this->size; $i++ ){
            echo "<tr>";
        for( $j = 0; $j < $this->size; $j++ ){
        echo "<td>".  $this->array[$i][$j]."</td>";
        }
        echo '</tr>';
        }
        
        echo '</table>';
    }
    
    public function reverse(){
        
        $sortedMatrix = array();
        
        for( $i = 0 ; $i < $this->size; $i++){
        for( $j = 0, $k = $this->size-1; $j < $this->size; $j++, $k-- ){
            
             $sortedMatrix[$j][$i] = $this->array[$i][$k];
          
        }
        }
        $this->array = $sortedMatrix;
        
    }
    
    public function clear($SIZE=5){
        
        $this->size = $SIZE;
      
        $firstValue = 1;
        
        for( $i = 0; $i < $this->size; $i++ ){
         for( $j = 0; $j < $this->size; $j++ ){
          $this->array[$i][$j]= $firstValue++;
            }
        }
        
    }

        public function secondReverse(){
        
           $sortedMatrix = array();
        
        for( $i = 0 ; $i < $this->size; $i++){
        for( $j = 0; $j < $this->size; $j++){
            
             $sortedMatrix[$j][$i] = $this->array[$i][$j];
          
        }
        }
        $this->array = $sortedMatrix;
        
    }
    
 
        
    public function spiralSort(){
        
        $i = 0;
        $j = 0;
        $w = $this->size-1;
        $l = 0;
         $sortedArray = array();     
        
            
            for($p = 0; $p < $this->size; $p++) {
              for($k = 0; $k < $this->size; $k++) {
                   
                $sortedArray[$i][$j] = $this->array[$p][$k];
                  
                   
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
            $this->array = $sortedArray;
    
            
    }
    
    
    
    public function zetSort(){
        
        $sortedArray = array();
        $row = array();
        
        for($i = 0; $i<$this->size; $i++){
            if( $i % 2 != 0 ){
                $row = array_reverse($this->array[$i]);
            }  else {
            $row = $this->array[$i];   
            }
            
            $sortedArray[$i] = $row;
           
        }
        
        $this->array = $sortedArray;
    }
    
    
   
     public function diagonalSort(){
        
        $i = 0;
        $j = 0;
        $mainDiagonal = false;
         $sortedArray = array();  
            
            for($p = 0; $p < 5; $p++) {
              for($k = 0; $k < 5; $k++) {
            
               $sortedArray[$i][$j] = $this->array[$p][$k];
             
               
               if($mainDiagonal == false){
                   
                if(($i==0) && ($j!=0) ){$i = ++$j; $j = 0;
                 if($i==5){$mainDiagonal= true; $i=4; $j=1; continue;}
              
                continue;}
                
                if(($i == 0) && ($j == 0)){$i++;continue;}
                
                if($i!=0){$i--;$j++;continue;} 
                
               }
               
               if($mainDiagonal== true){
                 
                   if($j!=4){$i--;$j++; continue;}
                   if($j==4){$j = ++$i; $i = $this->size-1;  continue;}
                   
               }
                
                 
               
             
               
              }
            }
           
            $this->array = $sortedArray;
            
              
            
            
            
}
        
    
    
}
    
