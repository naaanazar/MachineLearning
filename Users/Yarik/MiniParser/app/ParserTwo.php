<?php

namespace app;

class Parser {

    public $key;
    public $arr;
    public $str2 = '';
    public $j = 0;

    public function placed($elementArray, $i)
    {
        if ($elementArray == '[') {
            $this->j++;
            $this->key[$i] = $this->j;
        } elseif ($elementArray == ']') {
            $this->j--;
        } elseif ($elementArray == ',') {
            $this->key[$i] = $this->j;
        }
        return $this->key;
    }

    public function display($arr,$i) {
        for ($n = 0; $n < $i; $n++) {
            for ($q = 0; $q < $this->key[$n]; $q++) {
                echo "-";
            }
            echo $arr[$n].'<br>';
        }
    }

    public function placedStr ($str) {
        $i = 0;
        $k = new Parser();
        for($n = 0; $n < strlen($str); $n++) {
                if(is_numeric($str[$n])) {
                    $this->str2 = $this->str2.$str[$n];
                } elseif (($str[$n] == '[' || $str[$n] == ']' || $str[$n] == ',' ) && $this->str2 != '') {
                    $this->arr[$i] = $this->str2;
                    $this->str2 = '';
                    $i++;
                }
                if ($str[$n] == '[' || $str[$n] == ']' || $str[$n] == ',' ) {
                    $k->placed($str[$n] , $i);
                }
            }
            $k->display($this->arr,$i);
    }

    public function unPlacedStr ($str) {
        $i = 0;
        $k = new Parser();
        for($n = 0; $n < strlen($str); $n++) {
                if(is_numeric($str[$n])) {
                    $this->str2 = $this->str2.$str[$n];
                } elseif ($str[$n] == ',') {
                    $this->arr[$i] = $this->str2;
                    $this->str2 = '';
                    $i++;
                }
            }
            $this->arr[$i] = $this->str2;
            $i++;

            $k->display($this->arr,$i);
    }

    public function parser($str)
    {
        $k = new Parser();
        if ($str[0] == '[') {
            $k->placedStr($str);
        } else {
            $k->unPlacedStr($str);
        }
    }
}