<?php


class Result
{

    protected $sum = 0;

    public function matrix()
    {
        $width = 5;
        $hight = 4;
        

        $array = array(
            [1, 1, 1, 0, 0],
            [1, 1, 1, 0, 0],
            [1, 1, 1, 0, 1],
            [1, 1, 1, 0, 1]
        );


        $res = [];
        for ($i = 0; $i <= $hight - 1; $i++) {
            for ($j = 0; $j <= $width - 1; $j++) {

                if ($array[$i][$j] == 1) {
                    if (isset($array[$i + 1][$j]) && isset($array[$i][$j + 1]) && isset($array[$i + 1][$j + 1])
                        && $array[$i + 1][$j] == 1 && $array[$i][$j + 1] == 1 && $array[$i + 1][$j + 1] == 1
                    ) {
                        $res[$i . $j][$i][$j] = 1;
                        $res[$i . $j][$i + 1][$j] = 1;
                        $res[$i . $j][$i][$j + 1] = 1;
                        $res[$i . $j][$i + 1][$j + 1] = 1;

                        $n = 2;
                        while (isset($array[$i][$j + $n]) && isset($array[$i + 1][$j + $n])
                            && $array[$i][$j + $n] == 1 && $array[$i + 1][$j + $n] == 1) {
                            $res[$i . $j][$i][$j + $n] = 1;
                            $res[$i . $j][$i + 1][$j + $n] = 1;
                            $n++;
                        }

                        $number = count(reset($res[$i . $j]));
                        for ($k = $i + 1; $k < $hight; $k++) {
                            $arrayToCkeck = array_slice($array[$k], $j, $number);
                            if (!in_array(0, $arrayToCkeck)) {
                                $res[$i . $j][$k] = $arrayToCkeck;
                            }
                        }
                    }
                }
            }
        }
        echo "<pre>";
        var_dump($res);


    }


    public
    function rectangle()
    {


    }

    public
    function area()
    {
//echo $this->sum;
    }


}


