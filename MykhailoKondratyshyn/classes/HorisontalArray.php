<?php

require "../classes/NewArray.php";


class HorisontalArray extends NewArray
{
    public function horisontalArray()
    {
        $z = 0;
        $k = 6;
        

        for ($i = 0; $i < $k; $i++) {
            for ($j = 0; $j < $k; $j++) {
                $array[$i][$j] = $j + $z;


                echo $array[$i][$j] . " ";

            }
            $z = $z + $k;
            echo "<br>";
        }
    }
}