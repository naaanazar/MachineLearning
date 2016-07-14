<?php

namespace yu\app\sorters;

use yu\app\generators\generationArray;


class SortingArray extends generationArray
{
    
       public function printArrayStraight()
    {
        $array_to_print = "";
        foreach ($this->array as $row) {
            foreach ($row as $item) {
                $array_to_print .=  $item. "&nbsp;";
                if ($item < 10) {
                    $array_to_print .= "&nbsp;&nbsp;";
                }
            }
            $array_to_print .= "</br>";
        }
        echo $array_to_print;
    }
    
    public function transposeArray()
    {
        $array_to_print = "";
        for ($i = 0; $i < $this->elementsQuantity; $i++)
        {    
            for ($j = 0; $j < $this->elementsQuantity; $j++)
            {
                $array_to_print .= $this->array[$j][$i]. "&nbsp;";        
                if ($this->array[$j][$i] < 10)
                {
                    $array_to_print .= "&nbsp;&nbsp;";
                }        
            }
            $array_to_print .= "</br>";
        }
        echo $array_to_print;
    }
    
    public function transposeArrayInversion()
    {
        $array_to_print = "";
        for ($i = $this->elementsQuantity-1; $i >= 0; $i--)
        {    
            for ($j = $this->elementsQuantity-1; $j >= 0; $j--)
            {
                $array_to_print .= $this->array[$j][$i]. "&nbsp;";        
                if ($this->array[$j][$i] < 10)
                {
                    $array_to_print .= "&nbsp;&nbsp;";
                }        
            }
            $array_to_print .= "</br>";
        }
        echo $array_to_print;
    }   
    
   public function testArray()
   {
      $nerarray = array();
      
        for ($i=0; $i<1; $i++) 
        {
            for($j=0; $j<1; $j++)
            {
              echo "Here will be snake sort<br>";
            }
        }
   }  
}
?>
