<?php
echo "hello world";



/*
$str = "[123,[456,[789,[999,123]]]]";
$str2 = "";
$arr = [];
$g = 0;
$h = 0;

    for ($n = 0; $n < strlen($str); $n++) {
        if (is_numeric($str[$n])) {
            $str2 = $str2 . $str[$n];
            if (!is_numeric($str[$n + 1])) {
                $arr[$g][$h] = $str2;
                $str2 = '';
                echo "<pre>";
                print_r($arr);
            }
        }

        if ($str[$n] == "[") {
            $h++;
        }
        
        if ($str[$n] == "]") {
            $h--;
            $g--;
        }
    }