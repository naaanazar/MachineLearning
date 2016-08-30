<?php

$fr = fopen('sors.txt', 'r');
$fs = fopen('sors1.csv', 'w');

$st = file_get_contents('sors.txt', FILE_USE_INCLUDE_PATH);

$order = array("! ", "? ", ". ");
$str1 = str_replace($order, ".", $st);

$order2 = array("  ", "'", "'", '"', '"', ",", ":", ";", "—", "-", "{","}", "[", "]", "(", ")", "=", ">", "<", "/", "\\","|", "\n", "\t", "*", "^", "%", '$', "#", "@", "&", "→", "»", "«", "?", "!");
$str2 = str_replace($order2, " ", $str1);

$str = preg_replace('/\s+/', ' ', $str2);

$sentences = explode(".", $str);
print_r($sentences);

foreach ($sentences as $sentenc) {
    $words = explode(" ", $sentenc);
    $triada = [];
    for ($i=0; $i<count($words); $i++) {
        if (count($triada)==3) {
            $triada = [];
        } elseif ($i == 0) {
            fputcsv($fs, array (" ", " ", $words[$i]));
        } elseif ($i == 1) {
            fputcsv($fs, array (" ", $words[$i - 1], $words[$i]));
        } else {
            fputcsv($fs, array ($words[$i - 2], $words[$i - 1], $words[$i]));
        }
    }
}
fclose($fr);
fclose($fs);