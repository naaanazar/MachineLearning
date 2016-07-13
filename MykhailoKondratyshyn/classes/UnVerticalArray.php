<?php

/**
 * Created by PhpStorm.
 * User: dregan
 * Date: 11.07.16
 * Time: 23:44
 */
class UnVerticalArray extends  NewArray
{
    public function unVerticalArray()
    {
        $k = 5;
        $p = 5;


        $j = $p * $k;





        for ($i = $p; $i>=1; $i--) {

            foreach (array_reverse(range($i, $j, $k)) as $number) {
                echo "$number ";

            }
            echo "<br>";

            $j = $j - 1;


        }
        }
}