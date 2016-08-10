<?php

function read_dir_content($parent_dir, $depth = 0){
    $str_result = "";
$t .='&nbsp;&nbsp;';
    $str_result .= $t. dirname($parent_dir) ."</br>";
    $str_result .= $t;
    if ($handle = opendir($parent_dir))
    {
        while (false !== ($file = readdir($handle)))
        {
            if(in_array($file, array('.', '..'))) continue;
            if( is_dir($parent_dir . "/" . $file) ){
                $str_result .= $t . read_dir_content($parent_dir . "/" . $file, $depth++) . "</br>";
            }
            $str_result .= $t . "{$file}<br>";
        }
        closedir($handle);
    }
   // $str_result .= "</ul>";


    return $str_result;
}


echo "&nbsp;&nbsp;>".read_dir_content("/home/nazar/Crowdinspace");