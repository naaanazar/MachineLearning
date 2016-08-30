<?php

class MaximalRectangle
{
    private $maxRectangle = [
        'k1' => 0,
        'k2' => 0,
        'sum' => 0
    ];

    public function foundOne($array)
    {
        foreach ($array as $key1 => $arrayOfvalue) {
            foreach ($arrayOfvalue as $key2 => $value) {
                if ($value == 1) {
                    $this->target($array, $key1, $key2);
                }
            }
        }
        echo '<pre>';
        print_r($this->maxRectangle);
    }

    public function lookRight($array, $key1, $key2)
    {
        $sizeRight = 1;

        for (;;) {
            if ($key2 + $sizeRight == count($array)) {
                break;
            }

            if ($array[$key1][$key2 + $sizeRight] == 1) {
                $sizeRight++;
            } else {
                break;
            }
        }

        return $sizeRight;
    }

    public function lookDown($array, $key1, $key2)
    {
        $sizeDown = 1;

        for (;;) {
            if ($key1 + $sizeDown == count($array)) {
                break;
            }

            if ($array[$key1 + $sizeDown][$key2] == 1) {
                $sizeDown++;
            } else {
                break;
            }
        }
        return $sizeDown;
    }

    public function target($array, $key1, $key2)
    {
        $lookRight = $this->lookRight($array, $key1, $key2);
        $lookDown = $this->lookDown($array, $key1, $key2);
        $this->lookMaxRectangle($array, $lookRight, $lookDown, $key1, $key2);
    }

    public function lookMaxRectangle($array, $lookRight, $lookDown, $key1, $key2)
    {
        $lookR = $lookRight;
        $stepRight = 0;
        $stepDown = 0;
        $sum = 0;

        for (;;) {
            switch ($array[$key1 + $stepDown][$key2 + $stepRight]) {
                case 1:
                    $stepRight++;

                    if ($stepRight == $lookR) { //limit Right
                        $sum += $lookR;
                        $stepDown++;
                        $stepRight = 0;
                    }
                    break;
                case 0:
                    if ($this->maxRectangle['sum'] < $sum) {
                        $k2 = [$key1 + $stepDown - 1, $key2 + $lookR - 1];
                        $this->maxRectangle = [
                            'k1' => [$key1, $key2],
                            'k2' => $k2,
                            'sum' => $sum
                        ];

                        $sum = 0;
                    }

                    if ($stepDown == $lookDown) { //limit Down
                            break 2;
                    }

                    $lookR = $stepRight;
                    $sum = 0;
                    $stepRight = 0;
                    $stepDown = 0;

                    break;
                default:
                    break;
            }
        }
    }

}
