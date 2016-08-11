<?php

namespace arr\app;

/**
 * Description of matrixRectange
 *
 * @author Nazar
 */
class matrixRectange
{
    const R = 4;
    const C = 5;

    public $area = 0;

    public $matrix = [
        [1, 0, 1, 0, 0],
        [1, 0, 1, 1, 1],
        [1, 1, 1, 1, 1],
        [1, 0, 0, 1, 0]
    ];


    function getArea($matrix, $y1, $x1, $y2, $x2)
    {
        $sum = 0;
        $width = $x2 - $x1 + 1;
        $height = $y2 - $y1 + 1;
        global $area;

        for($i = 0; $i < $height; $i++) {
            for($j = 0; $j < $width; $j++) {
                if($matrix[$i + $y1][$j + $x1]) {
                    $sum++;
                }
            }
        }

        if($sum > $area && $sum == $height * $width) {
            $area = $sum;
        }
    }

    function makeRectangle($matrix)
    {
        for($y1 = 0; $y1 < R; $y1++) {
            for($x1 = 0; $x1 < C; $x1++) {

                for($y2 = $y1; $y2 < R; $y2++) {
                    for($x2 = $x1; $x2 < C; $x2++) {
                        getArea($matrix, $y1, $x1, $y2, $x2);
                    }
                }

            }
        }
    }
}
