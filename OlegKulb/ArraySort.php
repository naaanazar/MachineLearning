<?php

class ArraySort {
//    public function __construct($length) {
//        for($i = 0, $value = 1; $i <= $length - 1; $i++) {
//            for($i2 = 0; $i2 <= $length - 1; $i2++) {
//               $arrList[$i][$i2] = $value++;
//            }
//        } 
//        return $arrList;
//    }

    public function viewSortArray($viewArrays, $arraySize) {
        echo "<table>";
        for($i = 0; $i <= $arraySize; $i++) {
            echo "<tr>";
            for($i2 = 0; $i2 <= $arraySize; $i2++) {
                echo "<td>". $viewArrays[$i][$i2] . "</td>";
            }
            echo "</tr>"; 
        } 
        echo "</table>";
        
    }

    public function first($arrayOriginal, $arraySize) {
        
        for($i = 0; $i <= $arraySize; $i++) {
            for($i2 = 0; $i2 <= $arraySize; $i2++) {
                $sortFirst[$i2][$i] = $arrayOriginal[$i][$i2];
            }
        }
    
    return $sortFirst;
         
    }
    
    public function second($arrayOriginal, $arraySize) {
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
    
    public function therd($arrayOriginal, $arraySize) {
            $size = $arraySize;
            $sizeReverse = 0;
            $side = 1;
            $k1 = 0;
            $k2 = 0;
            $circleCounter = 0;
            
             foreach($arrayOriginal as $key1 => $arr1) {
                 foreach ($arr1 as $key2 => $arr2) {
//                     if ( isset($k1) && isset($k2) ){
//                         if($k2 == $size) {
//                             if($k1 == $size) {
//                                 $k2--;
//                             }else {
//                                 $k1++; 
//                             }
//                         }else {
//                             $k2++;
//                         }
//                     }else {
//                        $k1 = $key1;
//                        $k2 = $key2;
//                     }
                     $sortTherd[$k1][$k2]=$arrayOriginal[$key1][$key2];
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
}
