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


        $array = array();
        for ($i = 0; $i < $k; $i++) {
            for ($j = 0; $j < $k; $j++) {
                $array[$i][$j] = $j + $z;


                echo $array[$i][$j] . " ";

            }
            $z = $z + $k;
            echo "<br>";
        }


        $size = 5;
        $sizeReverse = 0;
        $side = 1;
        $k1 = 0;
        $k2 = 0;
        $circleCounter = 0;

        foreach ($array as $key1 => $arr1) {
            foreach ($arr1 as $key2 => $arr2) {
                $arraySort[$k1][$k2] = $array[$key1][$key2];
                switch ($side) {
                    case 1:
                        $k2++;
                        $side = ($k2 == $size) ? 2 : 1;
                        $circleCounter = ($side == 2) ? $circleCounter++ : $circleCounter;
                        break;
                    case 2:
                        $k1++;
                        $side = ($k1 == $size) ? 3 : 2;
                        break;
                    case 3:
                        $k2--;
                        $side = ($k2 == $sizeReverse) ? 4 : 3;
                        break;
                    case 4:
                        if (!isset($onece)) {
                            $sizeReverse++;
                            $size--;
                            $onece = 1;
                        }
                        $k1--;
                        $side = ($k1 == $sizeReverse) ? 1 : 4;
                        if ($side == 1) {
                            unset($onece);
                        }
                        break;
                }
            }
        }
        // $this->arraySort = $array;



        echo "<table border='1'>";

        for ($i = 0; $i <= 4; $i++) {
            echo "<tr>";

            for ($i2 = 0; $i2 <= 4; $i2++) {
                echo "<td>" . $array[$i][$i2] . "</td>";
            }

            echo "</tr>";
        }

        echo "</table><hr /><br />";
        return $array;
    }
}
