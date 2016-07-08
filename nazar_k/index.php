<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
       
        <?php
            $array = [
               [1, 2, 3, 4, 5],
               [6, 7, 8, 9, 10],
               [11, 12, 45, 14, 15],
               [16, 17, 18, 19, 20],
               [21, 22, 33, 24, 25]
            ];
            ob_start();
            array_out($array);
            array_unshift($array, null);
            $array = call_user_func_array('array_map', $array);
            echo '<br>Result<br>';
            array_out($array);          
            $out=ob_get_contents();
            ob_end_clean(); 
            write_to_file('array.html', $out);
            
            
            function array_out($array){
                foreach ($array as $j => $value) {
                foreach ($value as $i => $value) {
                        echo ' '. $value;
                    }
                echo '<br>';
                }
            }
            function write_to_file($file, $string){               
                file_put_contents($file, $string,  FILE_APPEND | LOCK_EX);
            }
          echo $out;
        ?>
    </body>
</html>