<?php
class Result
{
    protected $sum;
    public function matrix()
    {
        $width = 5;
        $hight = 4;
        $sum = 0;
        $array = array(
            [1, 0, 1, 0, 0],
            [1, 1, 1, 1, 1],
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
                    if (isset($array[$i + 1][$j]) && isset($array[$i][$j + 1]) && isset($array[$i + 1][$j + 1]))
                        if ($array[$i + 1][$j] == 1 && $array[$i][$j + 1] == 1 && $array[$i + 1][$j + 1] == 1) {
                            echo $array[$i][$j];
                            echo $array[$i + 1][$j];
                            echo "<br>";
                            echo $array[$i][$j + 1];
                            echo $array[$i + 1][$j + 1];
                            echo "<br>";
                            echo "<br>";
                            echo "<br>";
                            $this->sum = 4;
                            //break;
                            for ($m = 2; $m <= $hight - 1; $m++) {
                                for ($n = 2; $n <= $width - 1; $n++) {
                                    if (isset($array[$i][$j + $n]) && isset($array[$i + $m-1][$j + $n]))
                                        if ($array[$i][$j +$n] == 1 && $array[$i + $m-1][$j + $n] == 1) {
                                            $this->sum +=2;
                                            echo $this->sum;
                                            return $this->sum;
                                        }
                                }
                            }
                        }
                }
            }
        }
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
        echo $this->sum;
    }
}
