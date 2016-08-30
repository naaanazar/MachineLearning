<?php

$array = array(100, 4, 200, 1, 3, 2, 5);

$count = count($array);
for($i = 1; $i < $count; $i ++) {
    $j = $i - 1;
    $element = $array[$i];
    while ( $j >= 0 && $array[$j] > $element ) {
        $array[$j + 1] = $array[$j];
        $array[$j] = $element;
        $j = $j - 1;
    }
}
print_r($array);
$globalCounter = 0;
$counter = 0;
$start = 0;

for ($i = 0, $n = count($array); $i < $n; $i++) {
    if($i == 0) {
        $counter++;
    } elseif ($array[$i] - $array[$i - 1] == 1) {
        $counter++;
        if ($counter > $globalCounter) {
            $globalCounter = $counter;
            $start = $i - $globalCounter + 1;
        }
    } else {
        $counter = 0;
    }
}


$output = implode(", ", array_slice($array, $start, $globalCounter));

echo "The longest sequence are " . $globalCounter . " elements long.\n";
echo $output . "\n";