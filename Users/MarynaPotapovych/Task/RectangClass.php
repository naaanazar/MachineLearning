<?php


namespace liw\app;

class RectangClass
{

    const C = 5;

    public $area;
    public $matrix = [
        [1, 0, 1, 0, 0],
        [1, 0, 1, 1, 1],
        [1, 1, 1, 1, 1],
        [1, 0, 0, 1, 0]
    ];

    function getAr($matrix, $x1, $y1, $x2, $y2)
    {
        $sum = 0;
        $wigth = ($x2 - $x1) + 1;
        $heigth = ($y2 - $y1) + 1;

        global $area;

        for ($i = 0; $i < $heigth; $i ++) {
            for ($j = 0; $j < $wigth; $j ++) {
                if ($matrix[$i + $y1][$j + $x1]) {
                    $sum++;
                }
            }
        }
        if ($sum > $area && $sum == $heigth * $wigth) {
            $area = $sum;
        }
    }

    function makeRectang($matrix)
    {

        for ($y1 = 0; $y1 < R; $y1 ++) {
            for ($x1 = 0; $x1 < C; $x1 ++) {

                for ($y2 = $y1; $y2 < R; $y2 ++) {
                    for ($x2 = $x1; $x2 < C; $x2 ++) {
                        getAr($matrix, $x1, $y1, $x2, $y2);
                    }
                }
            }
        }
    }

}
