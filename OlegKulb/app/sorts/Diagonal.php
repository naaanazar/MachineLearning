<?php

namespace ex\app\sorts;

class Diagonal extends GeneralAbstractSort
{
    protected function sort()
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
