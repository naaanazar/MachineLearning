<?php

namespace Figure;
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
    
 
        
        
    }
        
    
    
    
    
    
    
    
