<?php

namespace ex\app;

class WriteFile
{
    public function writeArrayInFile($file, $array)
    {
        echo "<hr />";
        $fp = fopen($file, "a"); 
        $arrs = array('one' => 'Раз', 'two' => 'Два');
        foreach($array as $key1 => $arr1){
            foreach($arr1 as $key2 => $arr2){
                $test = fwrite($fp, $arr2."\t"); 
            }
            $test = fwrite($fp, "\r\n");
        }
        if ($test) echo 'YES';
        else echo 'ERROR';
        fclose($fp); 
        echo "<hr />";
    }
}
