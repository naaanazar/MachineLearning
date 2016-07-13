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
    
    public function printArray($array)
    {
        $array_to_print = "";
        foreach ($array as $row) {
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
    
    public function convertToOneDimension($array)
    {        
        $oneDimArray = array();
        foreach ($array as $row) {
            foreach ($row as $item) {
                array_push($oneDimArray, $item);
            }
        }
        
        array_unshift($oneDimArray, "");
        unset($oneDimArray[0]);
        
        return $oneDimArray;
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
    
    public function snakeArray()
    {
        $arr = $this->convertToOneDimension($this->array);
        $flag = true;
        $cnt = 0;
        $matrixSize = $this->elementsQuantity * $this->elementsQuantity;
        for ($i = 1; $i < $matrixSize+1; $i++) {
            
            if ($i % 5 == 0) {                
                echo $arr[$i] . "&nbsp;";
                if ($cnt != 0) {
                    for ($j = 1; $j <= $cnt; $j++) {
                        echo $arr[++$i] . "&nbsp;";
                        if ($j == $cnt) {
                            echo "</br>";
                        }
                    }                    
                } else {
                    echo '<br>';
                }  
                $cnt++;
                
                if ($flag == true) {                    
                    echo $arr[++$i] . "</br>";
                    $flag = false;
                } else {
                    echo str_repeat("&nbsp;", 20);
                    echo $arr[++$i] . "</br>";                
                    $flag = true;
                }
            } else {                                
                echo $arr[$i] . "&nbsp;";
                if ($arr[$i] < 10) {
                    echo "&nbsp;&nbsp;";
                }
            }  
            
        }        
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
    
    public function spiralArray()
    {
        $array_to_print = "";
        $spiralArray = array();
        for ($i = 0; $i < $this->elementsQuantity; $i++)
        {    
            for ($j = 0; $j < $this->elementsQuantity; $j++)
            {
                if ($i == 0) {
                    $array_to_print .= $this->array[$i][$j]. "&nbsp;";
                    $spiralArray[$i][$j] = $this->array[$i][$j];
                } elseif ($i == 1) {
                    $spiralArray[$i][$this->elementsQuantity--] = $this->array[$i][$j];
                } else {
                    break;
                }                
            }
            $array_to_print .= "</br>";
        }  
        echo "<pre>";
        print_r($spiralArray);
        echo "</pre>";        
    }
}
