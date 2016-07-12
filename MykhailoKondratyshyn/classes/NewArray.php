<?php

/**
 * Created by PhpStorm.
 * User: dregan
 * Date: 11.07.16
 * Time: 23:14
 */
class NewArray
{
    public function generateArray($k)
    {
        $z = 0;
        $array = array();

        for ($i = 0; $i < $k; $i++) {
            for ($j = 0; $j < $k; $j++) {

                $array[$i][$j] = $j+$z;

                echo $array[$i][$j] . " ";

            }
            $z = $z + 1;
            echo "<br>";

//            if ($j+1 % $k = 0) {
//
//                for ($q = 1; $q < $k; $q++) {
//
//                    echo $array[$q][$j] = ;
//                }
//
//                }else {
//
//
//                    echo "eeeee";
//                }

            $array[$i][$j] = $j+$z;

            echo $array[$i][$j] . " ";
        }


//        for ($i = 0; $i < $k; $i++) {
//            for ($j = 0; $j < $k; $j++) {
//                echo $array[$i][$j] . " ";
//
//
//            }
//            echo "<br>";
//        }

echo "<pre>";
        return $array;
    }
}