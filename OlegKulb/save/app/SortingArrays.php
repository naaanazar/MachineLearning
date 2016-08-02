<?php

namespace ex\app;

class SortingArrays
{
    private $arraySize;
    private $arrayForSorting;

    public function __construct($arraySize, $arrayForSorting)
    {
        $this->arraySize = $arraySize;
        $this->arrayForSorting = $arrayForSorting;
    }
    
    public function vertically()
    {        
        for ($i = 0; $i <= $this->arraySize; $i++) {
            for ($i2 = 0; $i2 <= $this->arraySize; $i2++) {
                $arraySort[$i2][$i] = $this->arrayForSorting[$i][$i2];
            }
        }
        return $arraySort; 
    }
    
    public function snake()
    {
        $counter = 1;
        
        foreach($this->arrayForSorting as $key1 => $arr1) {
            $coup = $this->arraySize;
            
            foreach ($arr1 as $key2 => $arr2) {
                if ($counter % 2) {
                    $arraySort[$key1][$key2] = $this->arrayForSorting[$key1][$key2];
                } else {
                    $arraySort[$key1][$coup] = $this->arrayForSorting[$key1][$key2];
                    $coup--;
                }
            }
            
            $counter++;
        }
        
        $this->arraySort = $arraySort;
        
        return $arraySort;
    }
    
    public function spiral()
    {
            $size = $this->arraySize;
            $sizeReverse = 0;
            $side = 1;
            $k1 = 0;
            $k2 = 0;
            $circleCounter = 0;
            
             foreach($this->arrayForSorting as $key1 => $arr1) {
                 foreach ($arr1 as $key2 => $arr2) {
                     $arraySort[$k1][$k2] = $this->arrayForSorting[$key1][$key2];
                     switch($side) {
                        case 1:
                            $k2++;
                            $side = ($k2 == $size) ? 2 : 1;
                            $circleCounter = ($side == 2) ? $circleCounter++ : $circleCounter;
                            break;
                        case 2:
                            $k1++;
                            $side = ($k1 == $size) ? 3 : 2;
                            break;
                        case 3:
                            $k2--;
                            $side = ($k2 == $sizeReverse) ? 4 : 3;
                            break;
                        case 4:
                            if( !isset($onece) ) {
                                $sizeReverse++;
                                $size--; 
                                $onece = 1;
                            }
                            $k1--;
                            $side = ($k1 == $sizeReverse) ? 1 : 4;
                            if($side == 1) {
                                unset($onece);
                            }
                            break;
                     }
                 }
             }
             $this->arraySort = $arraySort;
             return $arraySort;
    }
    
    public function diagonal()
    {
        $k1 = 0;
        $k2 = 0;
        $line = 0;
        $lengLine = 0;
        foreach($this->arrayForSorting as $key1 => $arr1) {
            foreach ($arr1 as $key2 => $arr2) {
                if($line < $this->arraySize + 1) {
                    if($k1 == 0 && $k2 == 0) {
                        $arraySort[$k1][$k2] = $this->arrayForSorting[$key1][$key2];
                        $line++;
                        $k2 = 1;
                    } else {
                        if($line == $lengLine) {
                            $arraySort[$k1][$k2] = $this->arrayForSorting[$key1][$key2];
                            $k1 = 0;//
                            $line++;
                            $k2 = $line;
                            $lengLine = 0;
                        }  else {
                            $arraySort[$k1][$k2] = $this->arrayForSorting[$key1][$key2];
                            $k1++;
                            $k2--;
                            $lengLine++;
                        }
                    }
                } else {
                    if( isset($arrRev) ) {
                        if($arrRev == 1) {
                            $k1 = $k1Rev;
                            $k1Rev++;
                            $k2 = $this->arraySize;
                            $arraySort[$k1][$k2] = $this->arrayForSorting[$key1][$key2];
                            $k1++;
                            $k2--;
                            $arrRev2--;
                            $arrRev = $arrRev2;
                           
                        } else {
                            $arraySort[$k1][$k2] = $this->arrayForSorting[$key1][$key2];
                            $k1++;
                            $k2--;
                            $arrRev--;
                        }
                        
                    } else {
                        $arrRev = $line - 1;
                        $arrRev2 = $arrRev;
                        $k1Rev = 1;
                        $k1 = $k1Rev;
                        $k2 = $this->arraySize;
                        $k1Rev++;
                        $arraySort[$k1][$k2] = $this->arrayForSorting[$key1][$key2];
                        $lengLine++;
                        $k1++;
                        $k2--;
                        
                    }

                }
                
            }
        }    
        $this->arraySort = $arraySort;
        return $arraySort;
    }
}
