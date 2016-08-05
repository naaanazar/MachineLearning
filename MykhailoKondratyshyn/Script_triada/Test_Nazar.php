<?php
$text = file_get_contents('file.txt');
$q=preg_match_all("/(.+?)(\.|\?|!|:){1,}(\s|<br(| \/)>|<\/p>|<\/div>)/is",$text,$out);
$fp = fopen('f.csv', 'a');

foreach ($out[1] as $key => $value) {
    $words = preg_split ("/[\s,-]+/" , $value) ;
    $array[0] = ['', '', $words['0']];
    $array[1] = ['', $words['1'], $words['2']];
    unset($words[0]);
    unset($words[1]);
    unset($words[2]);
    $words = array_chunk($words, 3);
    $result = array_merge ($array, $words);
    echo "<pre>";
    print_r($result);
    echo "</pre>";

    foreach ($result as $fields) {
        fputcsv($fp, $fields);
    }
}
fclose($fp);