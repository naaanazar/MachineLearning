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
            $array1 = call_user_func_array('array_map', $array);
            echo '<br>Result<br>';
            array_out($array1);
            
            $array_zip_d = zipper($array, 'DESC');
            echo '<br>Result2<br>';
            array_out($array_zip_d);
            
            $array_zip_a = zipper($array, 'ASC');
            echo '<br>Result3<br>';
            array_out($array_zip_a);
            
            $out=ob_get_contents();
            ob_end_clean(); 
            write_to_file('array.html', $out);
            
            function zipper($array, $sort){
                if ($sort == 'ASC'){
                    $f=1; 
                }
                if ($sort == 'DESC'){
                    $f=2; 
                }
                foreach ($array as $key => $value) {
                    if (is_array($value)){                    
                        $tmp=$array[$key]; 
                        if (($f % 2) == 0){
                            $array[$key] = array_reverse($tmp);
                        }
                        $f++;
                    }
                }
                return $array;
            }
            
            function array_out($array){
                foreach ($array as $j => $value) {
                    if (is_array($value)){
                        foreach ($value as $i => $value) {
                                echo ' '. $value;
                            }
                        echo '<br>';
                    }
                }            
            }
            function write_to_file($file, $string){               
                file_put_contents($file, $string,  FILE_APPEND | LOCK_EX);
            }
          echo $out;
        ?>
    </body>
</html>