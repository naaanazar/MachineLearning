<?php


class Result
{

    public function matrix()
    {
        $width = 5;
        $hight = 4;
        $sum = 1;
        $k = 0;

        $array = array(
            [1, 1, 1, 0, 1],
            [1, 1, 0, 1, 1],
            [1, 1, 1, 1, 1],
            [1, 0, 0, 1, 1]
        );

        for ($i = 0; $i <= $hight - 1; $i++) {
            for ($j = 0; $j <= $width - 1; $j++) {

                $rectangle = $array[$i][$j];

                if ($array[$i][$j] == 1) {
                    //$arrayOur[$i][$n] = $array[$i][$j];
                    for ($m = 1; $m <= $hight-$i-1; $m++) {
                        for ($n = 1; $n <= $width-$j-1; $n++) {
                            if ($array[$i][$j+$n] == 1) {
                               $arrayOur[$i][$n-1] = $array[$i][$j];
                                $arrayOur[$i][$n] = $array[$i][$j+$n-1];

                            }elseif ($array[$i+$m][$n] == 1) {

                                $arrayOur[$i+$m][$n] = $array[$i][$j];
                                $arrayOur[$i+$m][$n] = $array[$i][$j+$n-1];
                            }

                            echo "<pre>";

                        }

                    }
                }

            }
        }
        var_dump($arrayOur);
    }

    public
    function rectangle()
    {
        $array = array(
            [1, 0, 1, 0, 0],
            [1, 0, 1, 1, 1],
            [1, 1, 1, 1, 1],
            [1, 0, 0, 1, 0]
        );
//        echo "<pre>";
//        var_dump($array);


    }

    public
    function area()
    {

    }


}


