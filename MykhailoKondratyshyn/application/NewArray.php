<?php

namespace dregan\application;

/**
 * Created by PhpStorm.
 * User: dregan
 * Date: 11.07.16
 * Time: 23:14
 */



abstract class NewArray
{
    protected $arrayNew;

    abstract function sortArray();

    public function __construct($size)
    {
        $z = 1;
        for ($i = 0; $i <= $size - 1; $i++) {
            for ($j = 0; $j <= $size - 1; $j++) {
                $this->arrayNew[$i][$j] = $z++;
            }
        }
    }


    public function echoArray()
    {
        $arraySorted = $this->sortArray();
        for ($i = 0; $i <= count($this->arrayNew) - 1; $i++) {
            for ($j = 0; $j <= count($this->arrayNew) - 1; $j++) {

                echo $arraySorted[$i][$j] . " ";

            }
            echo "<br>";

        }


        echo "<pre>";
    }
}