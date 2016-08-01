<?php

foreach (range(1, 5) as $number) {
    echo "$number";
    file_put_contents('log.txt', $nubmer);

}

echo "<br>";
foreach (range(6, 10) as $number) {
    echo $number;
}
echo "<br>";
foreach (range(11, 15) as $number) {
    echo $number;
}
echo "<br>";
foreach (range(16, 20) as $number) {
    echo $number;
}
echo "<br>";

$w = 5;
$h = 5; //Сюда размер матрицы
function s($w, $h, $x, $y)
{


    return $y ? $w + s($h - 1, $w, $y - 1, $w - $x - 1) : $x;
}

for ($i = 0; $i < $h; $i++) {
    for ($j = 0; $j < $w; $j++) {

        printf("%4d", s($w, $h, $j, $i));
    }
    echo "<br>";
}