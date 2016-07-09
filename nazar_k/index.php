 <?php
    require_once 'classes/class.array_sort.php';        
        ob_start();           
        $sort_asc= new array_sort($array);
        $sort_asc->array_out($sort_asc->sort_array());
        echo $sort_asc->string;
        
        $sort_asc->array_out($sort_asc->sort_array($sort_asc->sort = 'DESC'));
        echo $sort_asc->string;         
       
        $ar_zip = new array_sort($array);      
        $ar_zip->array_out($ar_zip->zipper());        
        echo $ar_zip->string;
        
        $ar_zip->array_out($ar_zip->zipper($ar_zip->sort = 'DESC'));
        echo $ar_zip->string;
        
        $ar_zip->write_to_file();
        $sort_asc->write_to_file();   
        
        $out=ob_get_contents();
        ob_end_clean();           
          
        ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Array sort</title>
    </head>
    <body>
       <?php
          echo $out;  
       ?>
       
    </body>
</html>