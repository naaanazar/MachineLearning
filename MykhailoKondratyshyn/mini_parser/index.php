<?php

$str = "[123,[456,[78],[999,[888]],[777]]],[555,[444]]]";
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