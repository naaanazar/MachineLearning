<?php

/**
 * Created by PhpStorm.
 * User: dregan
 * Date: 11.07.16
 * Time: 23:44
 */
class SpiralArray extends NewArray
{
    public function spiralArray($k)
    {
        $z = 0;
        $x = 1;

//        for ($i = 0; $i < $k; $i++) {
//            for ($j = 0; $j < $k; $j++) {
//
//                $array[$i][$j] = $j + $z;
//
//                echo $array[$i][$j] . " ";
//            }
//            echo "<br>";
//            $z = $z + $k;
//        }


        for ($i = 0; $i < $k; $i++) {
            for ($j = 0; $j < $k; $j++) {


                    if ($j = $k) {
                        for ($q = 1; $q < $k; $q++) {
                            $array[$q][$j] = $j + $x;

                            echo $array[$q][$j] . " ";
                            $x++;
                        }
                    }else {
                        //$array[$i][$j] = $j + $z;

                        echo "hh ";
                    }
            }
            echo "<br>";
            $z = $z + $k;
        }





        echo "<br>";


        echo "<pre>";
        var_dump($array);
    }
}