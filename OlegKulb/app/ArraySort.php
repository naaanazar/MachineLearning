<?php
namespace ex\app;

class ArraySort
{
    public function first($arrayOriginal, $arraySize)
    {        
        for($i = 0; $i <= $arraySize; $i++) {
            for($i2 = 0; $i2 <= $arraySize; $i2++) {
                $sortFirst[$i2][$i] = $arrayOriginal[$i][$i2];
            }
        }
        return $sortFirst;  
    }
    
    public function second($arrayOriginal, $arraySize)
    {
        $counter = 1;
        foreach($arrayOriginal as $key1 => $arr1) {
            $coup = $arraySize;
            foreach($arr1 as $key2 => $arr2) {
                if($counter % 2) {
                    $sortSecond[$key1][$key2] = $arrayOriginal[$key1][$key2];
                } else {
                    $sortSecond[$key1][$coup] = $arrayOriginal[$key1][$key2];
                    $coup--;
                }
            }
            $counter++;
        }
        return $sortSecond;
    }
    
    public function therd($arrayOriginal, $arraySize)
    {
            $size = $arraySize;
            $sizeReverse = 0;
            $side = 1;
            $k1 = 0;
            $k2 = 0;
            $circleCounter = 0;
            
             foreach($arrayOriginal as $key1 => $arr1) {
                 foreach ($arr1 as $key2 => $arr2) {
                     $sortTherd[$k1][$k2] = $arrayOriginal[$key1][$key2];
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
             return $sortTherd;
    }
    
    public function fourth($arrayOriginal, $arraySize)
    {
        $k1 = 0;
        $k2 = 0;
        $line = 0;
        $lengLine = 0;
        foreach($arrayOriginal as $key1 => $arr1) {
            foreach ($arr1 as $key2 => $arr2) {
                if($line < $arraySize + 1) {
                    if($k1 == 0 && $k2 == 0) {
                        $sortFourth[$k1][$k2] = $arrayOriginal[$key1][$key2];
                        $line++;
                        $k2 = 1;
                    } else {
                        if($line == $lengLine) {
                            $sortFourth[$k1][$k2] = $arrayOriginal[$key1][$key2];
                            $k1 = 0;//
                            $line++;
                            $k2 = $line;
                            $lengLine = 0;
                        }  else {
                            $sortFourth[$k1][$k2] = $arrayOriginal[$key1][$key2];
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
                            $k2 = $arraySize;
                            $sortFourth[$k1][$k2] = $arrayOriginal[$key1][$key2];
                            $k1++;
                            $k2--;
                            $arrRev2--;
                            $arrRev = $arrRev2;
                           
                        } else {
                            $sortFourth[$k1][$k2] = $arrayOriginal[$key1][$key2];
                            $k1++;
                            $k2--;
                            $arrRev--;
                        }
                        
                    }else {
                        $arrRev = $line - 1;
                        $arrRev2 = $arrRev;
                        $k1Rev = 1;
                        $k1 = $k1Rev;
                        $k2 = $arraySize;
                        $k1Rev++;
                        $sortFourth[$k1][$k2] = $arrayOriginal[$key1][$key2];
                        $lengLine++;
                        $k1++;
                        $k2--;
                    }
                }
            }
        }    
        return $sortFourth ;
    }
}
