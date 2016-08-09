<?php

$i = 0;
$dir = '/home/crowdin_share';

if ($handle = opendir($dir)) {
    echo "Дескриптор каталога: $handle<br>";
    echo "Записи:<br>";

    $element = readdir($handle);





    while (($file = readdir($handle)) !== false) {


        echo "$file<br>";
        $arr[$i] = $file;
        $i++;
    }

    for ($j = 0; $j<=$i; $j++) {

        echo filetype($dir . $arr[$i]);

    }










    echo "<pre>";

var_dump($arr);


    closedir($handle);
}