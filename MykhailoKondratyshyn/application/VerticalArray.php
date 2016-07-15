<?php

namespace dregan\application;

/**
 * Created by PhpStorm.
 * User: dregan
 * Date: 11.07.16
 * Time: 23:43
 */
class VerticalArray extends NewArray
{
    public function sortVerticalArray()
    {
        $arraySorted = array();

        for ($i = 0; $i <= count($this->arrayNew) - 1; $i++) {
            for ($j = 0; $j <= count($this->arrayNew) - 1; $j++) {
                $arraySorted[$j][$i] = $this->arrayNew[$i][$j];

            }
        }


        for ($i = 0; $i <= count($this->arrayNew) - 1; $i++) {
            for ($j = 0; $j <= count($this->arrayNew) - 1; $j++) {

                echo $arraySorted[$i][$j] . " ";

            }
            echo "<br>";

        }


        echo "<pre>";


    }

}