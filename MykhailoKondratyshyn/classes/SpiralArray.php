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
        // $z = 0;
        $array = array();

        $i = 0;
        for ($j = 0; $j < $k; $j++) {

            $array[$i][$j] = $j;

            echo $array[$i][$j] . " ";

        }


        for ($d = 0; $d < $k; $d++) {

            $array[$d][$j] = $d + $k;

            echo $array[$i][$j] . " ";

        }



        echo "<br>";


        echo "<pre>";
        return $array;
    }
}