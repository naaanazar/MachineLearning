<?php

namespace liw\app;

class SequenceClass
{

    public $array = [100, 1, 12, 2, 3231, 3, 8, 4];
    public $sortArr = [];
    public $sequance = [];
    public $cnt = 1;

    public function sortArray()
    {
        $array_size = count($this->array);
        for ($i = 0; $i < $array_size; $i ++) {
            for ($j = 0; $j < $array_size; $j ++) {
                if ($this->array[$i] < $this->array[$j]) {
                    $tem = $this->array[$i];
                    $this->array[$i] = $this->array[$j];
                    $this->array[$j] = $tem;
                }
            }
        }
        echo "<pre>";
        print_r($this->array);
        echo "</pre>";
    }

    public function findSeq()
    {
        for ($i = 0; $i < count($this->array) - 1; $i++) {
            if ($this->array[$i + 1] - $this->array[$i] == 1) {
                $this->cnt++;
            }
        }
        echo $this->cnt;
    }

}
