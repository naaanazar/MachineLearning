<?php

namespace app;

class LongestConsecutiveSequence {

    public $arrayLength = 50;


    protected $newArr;

    public function __construct()
    {
        /**
         * Створюєм масив і заповнюєм його
         */
        for ($i = 0; $i < $this->arrayLength; $i++) {
            $this->newArr[$i] = rand(0,100);
        }
//        $this->newArr = array (11,1,2,3,4,6,7,8,9,10,14,15,16,17,18,1);
    }

    public function display()
    {
        echo '<pre>';
        for ($i=0; $i<$this->arrayLength; $i++){
            echo $this->newArr[$i] . " ";
        }
    }

    public function sort()
    {
        for ($i = 0; $i < $this->arrayLength; $i++) {
            for ($j = 1; $j < $this->arrayLength; $j++) {
                if ($this->newArr[$j] < $this->newArr[$j - 1]) {
                    $tr = $this->newArr[$j];
                    $this->newArr[$j] = $this->newArr[$j - 1];
                    $this->newArr[$j - 1] = $tr;
                }
            }
        }
    }

    public function consecutiveSequence()
    {
//        Найдовша послідовність
        $count = 1;
        $counter = 1;

        for ($i = 0; $i < $this->arrayLength - 1; $i++) {
            $x = $this->newArr[$i + 1] - $this->newArr[$i];
            if ($this->newArr[$i + 1] > $this->newArr[$i] && $x == 1) {
                $poz = $i;
                $count++;
            } elseif ($count > $counter) {
                $pozition = $poz + 2 - $count;
                $counter = $count;
                $count = 1;
            } else {
                $count = 1;
            }
        }
        echo '<pre> Longest consecutive sequence = ';
        for ($i = $pozition; $i < $pozition+$counter; $i++) {
            echo $this->newArr[$i] . " ";
        }
    }


//    public function allConsecutiveSequence()
//    {
////        Всі послідовності в масиві
//        $count = 1;
//        $poz = 1;
//        for ($i = 0; $i < $this->arrayLength - 1; $i++) {
//            $x = $this->newArr[$i + 1] - $this->newArr[$i];
//            if ($this->newArr[$i + 1] > $this->newArr[$i] && $x == 1) {
//                $poz = $i;
//                $count++;
//            }
//            else {
//                $pozz[] = $poz + 2 - $count;
//                $kil[] = $count;
//                $count = 1;
//            }
//        }
//        $pozz[] = $poz + 2 - $count;
//        $kil[] = $count;
//        $j = 0;
//        for ($i=0; $i<count($kil); $i++) {
//            if ($kil[$i] == max($kil)) {
//                $j = $i;
//                echo 's = '. $j;
//            }
//        }
//        for ($i = $pozz[$j]; $i < $pozz[$j]+$kil[$j]; $i++) {
//            echo $this->newArr[$i] . " ";
//        }
//    }
}