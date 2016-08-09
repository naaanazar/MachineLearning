<?php


$arr = array(100, 4, 200, 1, 3, 2, 5);
$sum = 1;
for ($i = 0; $i < count($arr); $i++) {
    for ($j = 1; $j < count($arr); $j++) {
        if ($arr[$j] < $arr[$j - 1]) {
            $a = $arr[$j];
            $arr[$j] = $arr[$j - 1];
            $arr[$j - 1] = $a;
            //$i = 0;
        }
    }
}

for ($i = 0; $i < count($arr); $i++) {
//    if ($arr[$i + 1] - $arr[$i] == 1){
//        echo $arr[$i];
//
//    }
    if ($arr[$i + 1] - $arr[$i] == 1) {
        $ar[$i+1] = $arr[$i+1];
        //echo $arr[$i+1];
        $sum++;
    }elseif ($arr[$i + 1] - $arr[$i] !== 1){

        break;
    }


}
echo $sum;

//echo "<pre>";
//var_dump($arr);
