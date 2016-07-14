<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Arrays
 *
 * @author dron
 */
class Arrays 
{
    public $array;
    

    public function ArrayInit($number)
    {
        $this->array = [];

        for ($i = 0; $i < $number; $i++) { 
            $this->array[$i] = [];
        }
    }

    public function ArrayFeel($number)
    {	
        $this->ArrayInit($number);
        $counter = 1;

        for ($i = 0; $i < $number; $i++) { 
            for ($j = 0; $j < $number; $j++) { 
                $this->array[$i][$j] = $counter++;
            }
        }
        
        return $this->array;
    }
    
    public function Vert($number)
    {
        $this->ArrayInit($number);
        $counter = 1;
        
        for ($j = 0; $j < $number; $j++) { 
            for ($i = 0; $i < $number; $i++) {  
                $this->array[$i][$j] = $counter++;
            }
        }
        
        return $this->array;
    }

    public function VertRev($number)
    {   
        $this->ArrayInit($number);
        $count = 1;
        
        for ($j = $number - 1; $j >= 0; $j--) { 
            for ($i = $number - 1; $i >= 0; $i--) { 
                $this->array[$i][$j] = $count++;   
            }
        }
        
        return $this->array;
    }
    
    public function Snake($number)
    {
        $this->ArrayInit($number);
        $count = 1;
        
        for ($i = 0; $i < $number; $i++) { 
            if ($i % 2 == 0){
                for ($j = 0; $j < $number; $j++) {
                    $this->array[$i][$j] = $count++;
                }
            } else { 
                for ($j = $number - 1; $j >= 0; $j--) {  
                    $this->array[$i][$j] = $count++;
                }                           
            }
        }
        
        return $this->array;
    }
    
    public function SpiralFeel($number, $method)
    {	
        $this->ArrayInit($number);

        if ($method == 1) {
            $count1 = 1;
        } else {
            $count1 = $number * $number;
        }

        $i = $j = 0;
        $right = $number - 1;
        $left = 0;

        for ($n = 0; $n < $number * $number; ++$n) {
        	if ($method == 1) {
                $this->array[$i][$j] = $count1++;
            } else {
                $this->array[$i][$j] = $count1--;
            }

            if (($i == ($left + 1)) && ($j == $left)) { 
                $right--;
                $left++;
            } 

            if (($j == $right) && ($i < $right)) { 
                $i++;
                continue;
            } 
            
            if (($j < $right) && ($i == $left)) {
                $j++; 
                continue;
            } 

            if (($i == $right) && ($j > $left)) { 
                $j--;
                continue;
            } 

            if (($j == $left) && ($i > $left)) {
                $i--; 
                continue;
            } 
        }

        return $this->array;
    }

    public function DiagFeel($number)
    {	
        $this->ArrayInit($number);

        $x = 0; 
        $y = 0; 
        $count2 = 1;
                    
        for ($i = 0; $i < $number; $i++) { 
            $x = 0;
            $y = $i;
            
            while ($y >= 0) {
               	$this->array[$x][$y] = $count2++;
                $x++;
                $y--;
            }
        }
                    
        for ($i = 1; $i < $number; $i++) { 
            $x = $i;
            $y = $number - 1;
                       
            while ($x <= $number - 1) {
                $this->array[$x][$y] = $count2++;
                $x++;
                $y--;
            }
        }

        return $this->array;
    }
}
