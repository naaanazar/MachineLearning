<?php

namespace sa\app;

use \sa\app\sorters\BaseSort\BaseSort;

class ArrayOut
{

    public $file = 'tmp/array.html';

    public function arrayOut($array)
    {
        $out = '';

        foreach ($array as $j => $value) {
            $tds = '';
            
                foreach ($value as $i => $value) {
                    $tds .= sprintf('<td>%s</td>', $value);
                }
            
           $out .= sprintf('<tr>%s</tr>', $tds);
        }

        $out = sprintf("
            <div style='display: inline-block; margin:10px;'>
                 <table>
                     <caption>%s</caption>
                     <tr>%s</tr>
                     
                </table>
            </div>",
            BaseSort::$title, $out
        );

        echo $out;
    }
        
    public function writeToFile($str)
    {
    file_put_contents($this->file, $str, LOCK_EX);
    }
    

}
