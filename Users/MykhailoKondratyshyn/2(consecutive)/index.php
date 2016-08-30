<?php


$arr = array(100, 4, 200, 1, 3, 2, 5, 201, 204, 202, 203, 206, 205);
$sum = 1;
$sum2 = 1;
for ($i = 0; $i < count($arr); $i++) {
    for ($j = 1; $j < count($arr); $j++) {
        if ($arr[$j] < $arr[$j - 1]) {
            $a = $arr[$j];
            $arr[$j] = $arr[$j - 1];
            $arr[$j - 1] = $a;

        }
    }
}

for ($i = 0; $i < count($arr); $i++) {

    if ($arr[$i + 1] - $arr[$i] == 1) {
        $ar[$i + 1] = $arr[$i + 1];
        $sum++;
    } elseif ($arr[$i + 1] - $arr[$i] !== 1) {

        break;
    }


}

for ($j = count($arr) - 1; $j >= 0; $j--) {

    if ($arr[$j] - $arr[$j - 1] == 1) {
        $sum2++;
    } elseif ($arr[$j] - $arr[$j - 1] !== 1) {

        break;
    }


}

if ($sum > $sum2) {
    echo $sum;
} else {
    echo $sum2;
}
