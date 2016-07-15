<?php

/**
 * Created by PhpStorm.
 * User: dregan
 * Date: 11.07.16
 * Time: 23:44
 */
class UnVerticalArray extends NewArray
{
    public function sortUnVerticalArray()
    {
        $q = count($this->arrayNew) - 1;

        $arraySorted = array();

        for ($i = 0; $i <= count($this->arrayNew) - 1; $i++) {
            for ($j = 0; $j <= count($this->arrayNew) - 1; $j++) {
                $arraySorted[$j][$q] = $this->arrayNew[$i][$j];

            }
            $q--;
        }
        $array = array_reverse($arraySorted);

        for ($i = 0; $i <= count($this->arrayNew) - 1; $i++) {
            for ($j = 0; $j <= count($this->arrayNew) - 1; $j++) {

                echo $array[$i][$j] . " ";

            }
            echo "<br>";

        }


        echo "<pre>";
    }
}