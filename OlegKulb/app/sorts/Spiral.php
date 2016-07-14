<?php

namespace ex\app\sorts;

class Spiral extends GeneralAbstractSort
{
    public function sort()
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

}
