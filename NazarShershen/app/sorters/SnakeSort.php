<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace arr\app\sorters;

/**
 * Description of SnakeSort
 *
 * @author Nazar
 */
class SnakeSort extends BaseSort
{
    public function sortArray()
    {
        $arr = $this->convertToOneDimension($this->array);
        $flag = true;
        $cnt = 0;
        $matrixSize = $this->elementsQuantity * $this->elementsQuantity;
        for ($i = 1; $i < $matrixSize+1; $i++) {

            if ($i % 5 == 0) {
                echo $arr[$i] . "&nbsp;";
                if ($cnt != 0) {
                    for ($j = 1; $j <= $cnt; $j++) {
                        echo $arr[++$i] . "&nbsp;";
                        if ($j == $cnt) {
                            echo "</br>";
                        }
                    }
                } else {
                    echo '<br>';
                }
                $cnt++;

                if ($flag == true) {
                    echo $arr[++$i] . "</br>";
                    $flag = false;
                } else {
                    echo str_repeat("&nbsp;", 20);
                    echo $arr[++$i] . "</br>";
                    $flag = true;
                }
            } else {
                echo $arr[$i] . "&nbsp;";
                if ($arr[$i] < 10) {
                    echo "&nbsp;&nbsp;";
                }
            }

        }
    }
}
