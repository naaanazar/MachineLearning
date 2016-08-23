<?php

class Parser
{
    public function parser($str)
    {
        $str2 = '';
        $i = 0;
        $j = 0;
        if ($str[0] == '[') {
            for($n = 0; $n < strlen($str); $n++) {
                if(is_numeric($str[$n])) {
                    $str2 = $str2.$str[$n];
                } elseif (($str[$n] == '[' || $str[$n] == ']' || $str[$n] == ',' ) && $str2 != '') {
                    $arr[$i] = $str2;
                    $str2 = '';
                    $i++;
                }
                if ($str[$n] == '[') {
                    $j++;
                    $key[$i] = $j;
                } elseif ($str[$n] == ']') {
                    $j--;
                } elseif ($str[$n] == ',') {
                    $key[$i] = $j;
                }   
            }
            for ($n = 0; $n < $i; $n++) {
                for ($q = 0; $q < $key[$n]; $q++) {
                    echo "-";
                }
                echo $arr[$n]."<br>";
            }
        } else {
            for($n = 0; $n < strlen($str); $n++) {
                if(is_numeric($str[$n])) {
                    $str2 = $str2.$str[$n];
                } elseif ($str[$n] == ',') {
                    $arr[$i] = $str2;
                    $str2 = '';
                    $i++;
                }
            }
            $arr[$i] = $str2;
            $i++;
            for ($n = 0; $n < $i; $n++) {
                echo $arr[$n]."<br>";
            }
        }
    }
}

$str = '[123,555]';

(new Parser())->parser($str);