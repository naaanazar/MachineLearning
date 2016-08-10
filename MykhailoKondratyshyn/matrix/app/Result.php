<?php


class Result
{

    public function matrix()
    {
        $width = 5;
        $hight = 4;


        $array = array(
            [1, 0, 1, 0, 0],
            [1, 0, 1, 1, 1],
            [1, 1, 1, 1, 1],
            [1, 0, 0, 1, 0]
        );


//        for ($i = 0; $i <= $hight - 1; $i++) {
//            for ($j = 0; $j <= $width - 1; $j++) {
//                $array[$i][$j];
//            }
//
//        }
        for ($i = 0; $i <= $hight - 1; $i++) {
            for ($j = 0; $j <= $width - 1; $j++) {

                if ($array[$i][$j] == 1) {
                    $arrayOur[0][0] = $array[$i][$j];




                    if (isset($array[$i + 1][$j]) && isset($array[$i][$j + 1]) && isset($array[$i + 1][$j + 1]))
                        if ($array[$i + 1][$j] == 1 && $array[$i][$j + 1] == 1 && $array[$i + 1][$j + 1] == 1) {
                            $arrayOur[0 + 1][0] = 1 && $arrayOur[0][0 + 1] = 1 && $arrayOur[0 + 1][0 + 1] = 1;
                            echo $arrayOur[0][0];

                        }
                    //var_dump($arrayOur);
                }
            }
        }
        echo "<pre>";
        var_dump($arrayOur);
    }

    public function rectangle()
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


