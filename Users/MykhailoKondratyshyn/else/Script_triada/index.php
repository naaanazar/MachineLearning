<?php


$str = 'This is Crowdin Space! Hello my world';


$order = array("!", "?");
$newstr = str_replace($order, '.', $str);


$sen = explode('. ', $newstr);

echo "<pre>";
print_r($sen);


$fp = fopen('file.csv', 'w');

foreach ($sen as $sentence) {
    $words = explode(" ", $sentence);
    $triada = [];

    for ($i = 0; $i < count($words); $i++) {
        if (count($triada) == 3) {
            fputcsv($fp, $triada);
            $triada = [];

        } elseif ($i == 0) {
            fputcsv($fp, array(" ", " ", $words[$i]));

        } elseif ($i == 1) {
            fputcsv($fp, array(" ", $words[$i - 1], $words[$i]));


        } else {
            fputcsv($fp, array($words[$i - 2], $words[$i - 1], $words[$i]));
        }

    }


    echo "<pre>";
    print_r($words);
}
fclose($fp);


//$chars = preg_split('/ /', $sen, -1, PREG_SPLIT_OFFSET_CAPTURE);


//echo "<pre>";
//print_r($chars);


?>