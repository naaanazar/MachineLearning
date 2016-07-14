 <?php
 
    ini_set('error_reporting', E_ALL);
    ini_set('display_errors',1);
    ini_set('display_startup_errors', 1);    
  
    require __DIR__ . '/../vendor/autoload.php';
    
    use sa\app\FactoryArray;
    
    use sa\app\sorters\BaseSort;
    use sa\app\NewArray; 
    use sa\app\ArrayOut;
    
    $newArray = new NewArray;
        
    if (isset($_POST['w1']) && isset($_POST['h1']) ){        
        $array = $newArray->crArray($_POST['h1'], $_POST['w1'], $_POST['type']);   
    } else {
        $array = $newArray::$array;
    }
    
    ob_start(); 
    
    $arrayOut = new ArrayOut; 
    $sorterFactory = new FactoryArray;    
    
    // autoload classes to factory
    $SortClasses = scandir('../app/sorters');      
    
    if (!$SortClasses == false){
        $i=1;
        
        foreach ($SortClasses as $key => $value) {          
            $class = substr($value, 0, -4);
            
            if  (method_exists('sa\app\sorters\\'.$class, 'addToFactoryArray') and $class != 'BaseSort'){                         
                $sorter = $sorterFactory::sort($class);
                $arrayOut->arrayOut($sorter->sortArrayType('ASC'));
                $arrayOut->arrayOut($sorter->sortArrayType('DESC')); 
                
//How todo:  sa\app\sorters\HorizontalSort::addToFactoryArray();                
            }    
        }        
    }    
     
    $out=ob_get_contents();
    ob_end_clean(); 
    
    $arrayOut->writeToFile($out."<br><a href='../index.php'>back to index.php<a>");                
          
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
        <p>
        Enter array size if you want to change the size of the array
        <form action ='index.php' method='post'>
            <input type='number' name='w1' value="" placeholder='width' required> 
            <input type='number' name='h1' value="" placeholder='height' required><br>            
            <input type='radio' name='type' value='successively' checked>successively<br>
            <input type='radio' name='type' value='random'>random<br>
            <input type='submit' value='reload'>          
        </form>
        <a href='tmp/array.html'>Open the recorded file</a>       
    </body>
</html>