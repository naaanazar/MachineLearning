<?php

require "../classes/NewArray.php";


class HorisontalArray extends NewArray
{
    public function horisontalArray()
    {
        $array2 = array();

        for ($i = 0; $i < $k; $i++) {
            for ($j = 0; $j < $k; $j++) {
                $array2[$i][$j] = $array;


                echo $array2[$i][$j] . " ";

            }
            echo "<br>";
    }
}