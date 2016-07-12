<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of arrayClass
 *
 * @author Nazar
 */


class arrayClass
{
    public $elementsQuantity = 5;
    public $array = array();

    public function __construct()
    {
        $cnt = 0;
        for ($i = 0; $i < $this->elementsQuantity; $i++) {
            for ($j = 0; $j < $this->elementsQuantity; $j++) {
                $cnt++;
                $this->array[$i][$j] = $cnt;   
            }            
        }        
    }
    
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
}
