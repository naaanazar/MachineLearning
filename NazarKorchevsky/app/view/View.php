<?php

namespace sa\app\view;

use \sa\app\sorters\BaseSort\BaseSort;

class View
{
   public static $out;
   
   public static function getHtml()
   {
       self::$out = sprintf("<!DOCTYPE html>
            <html>
                <head>
                    <meta charset='UTF-8'>
                    <title>Array sort</title>
                </head>
                <body>                    
                    %s
                    <p>
                        Enter array size if you want to change the size of the array
                    <form action ='index.php' method='post'>
                        <input type='number' name='w1' value='' placeholder='width' required>
                        <input type='number' name='h1' value='' placeholder='height' required><br>
                        <input type='radio' name='type' value='successively' checked>successively<br>
                        <input type='radio' name='type' value='random'>random<br>
                        <input type='submit' value='reload'>
                    </form>
                    <a href='tmp/array.html'>Open the recorded file</a>
                </body>
            </html>"
            , self::$out
        );
       
        return self::$out;
   }
    
}
