<?php


class Result
{

    public function matrix()
    {

        $sum = 0;
        $a = 0;
        $m = 2;
        $array = array(
            [1, 1, 1, 0, 0],
            [1, 1, 1, 1, 1],
            [1, 1, 1, 1, 1],
            [1, 0, 0, 1, 1]
        );

        for ($i = 0; $i <= count($array) - 1; $i++) {
            for ($j = 0; $j <= count($array) - 1; $j++) {

                $rectangle = $array[$i][$j];

                if ($array[$i][$j] == 1) {
                    $arrayOur[0][0] = $array[$i][$j];
                    for ($m = 1; $m <= count($array); $m++) {
                        if ($array[$i][$j + $m] == 1)
                            $arrayOur[0][$m] = $array[$i][$j + $m];
                        echo "<pre>";

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


