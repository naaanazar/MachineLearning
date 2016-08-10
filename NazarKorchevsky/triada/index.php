<?php
//error_reporting(E_ALL); ini_set('display_errors', 1);

$str = file_get_contents('file.txt');
$a = array("\t", "\n", "\r", "\0", "\x0B");


//$text = "Скажіть мені якесь речення. Скажіть мені якесь речення!  1111 1112 2  33 3 3 43 4 4 4 4  5 5 5 34444";
$text = str_replace($a, "", $str);
$b = array(".", "!", "?");
$out = explode(".", $str);
$out = preg_replace("/(\s){2,}/",' ',$out);
//$q=preg_match_all("/(.+?)(\.|\?|!|:){1,}(\s|<br(| \/)>|<\/p>|<\/div>)/is",$text,$out);
$fp = fopen('f.csv', 'a');

foreach ($out as $key => $value) { 
  
    $words = preg_split ("/[\s,-.(.#.*.).(.\".!.\;.«.]+/" , $value) ;

    for ($i = 0; $i < count($words); $i++){

        $result[] = $words[$i-2];
        $result[] = $words[$i-1];
        $result[] = $words[$i];
    }
    $res = array_chunk($result, 3);
    echo "<pre>";
       print_r($res);
       echo "</pre>";

    foreach ($res as $fields) {
           fputcsv($fp, $fields);
    }
}

fclose($fp);

/*echo "<pre>";
       print_r($out);
       echo "</pre>";
foreach ($out as $key => $value) {
  $b = array(".", "!", "?", ",");
  $str = trim(str_replace($b, "", $value));


    $words = explode(" ", $str);*/
