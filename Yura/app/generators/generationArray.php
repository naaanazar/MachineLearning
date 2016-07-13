<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace yu\app\generators;
/**
 * Description of generationArray
 *
 * @author yurii
 */
class generationArray 
{
    protected $elementsQuantity = 5;
    protected $array = array();
    
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
}
