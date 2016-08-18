<?php
$array = [5, 6, 7, 8, 9, 1213, 32, 45, 56, 1, 23,  27 ,28, 29];
echo "<pre>";
print_r(longestConsecutive($array));

function longestConsecutive($array) {

    for ($i=0; $i< count($array); $i++) {

        if ($array[$i]+1 == $array[$i+1]){
            $newArray[] =  $array[$i];

            if ($array[$i+1]+1 !== $array[$i+1]) {
                $newArray[$i+1] =  $array[$i+1];        }

        } else {

            if (count($newArray) >  count($longest)) {
                $longest = $newArray;
            }

            unset($newArray);
        }

    }
    return $longest;
}