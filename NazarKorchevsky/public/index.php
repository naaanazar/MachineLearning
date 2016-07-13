 <?php
 
    ini_set('error_reporting', E_ALL);
    ini_set('display_errors',1);
    ini_set('display_startup_errors', 1);    
  
    require __DIR__ . '/../vendor/autoload.php';
    
    use sa\app\FactoryArray;
    
   use sa\app\SortZipper;
    use sa\app\SortSpiral;
    use sa\app\SortVertical;
    use sa\app\SortHorizontal;
    
    use sa\app\ArraySort;
    use sa\app\NewArray; 
    use sa\app\ArrayOut;
    
    $newArray = new NewArray;
        
    if (isset($_POST['w1']) && isset($_POST['h1']) ){        
        $array = $newArray->crArray($_POST['h1'], $_POST['w1'], $_POST['type']);   
    } else {
        $array = $newArray->array;
    }
    
    ob_start();  
    
    $arrayOut = new ArrayOut($array);    
    
    $horizontal = FactoryArray::sort('Horizontal', $array);
    $arrayOut->arrayOut($horizontal->sortArrayType('ASC'));
    $arrayOut->arrayOut($horizontal->sortArrayType('DESC'));    
    
    $zipper = FactoryArray::sort('Zipper', $array);
    $arrayOut->arrayOut($zipper->sortArrayType('ASC'));
    $arrayOut->arrayOut($zipper->sortArrayType('DESC'));
  
    //$sortSpiral = new  call_user_func('SortSpiral' ,$array);
   // $sortSpiral = new SortSpiral($array);
    //$arrayOut->arrayOut($sortSpiral->sortArrayType('ASC'));
   // $arrayOut->arrayOut($sortSpiral->sortArrayType('DESC'));
    
    /*$sortHorizontal = new SortHorizontal($array);
    $arrayOut->arrayOut($sortHorizontal->sortArrayType('ASC'));
    $arrayOut->arrayOut($sortHorizontal->sortArrayType('DESC'));

    $sortZipper = new SortZipper($array);
    $arrayOut->arrayOut($sortZipper->sortArrayType('ASC'));
    $arrayOut->arrayOut($sortZipper->sortArrayType('DESC'));
    
    $sortSpiral = new SortSpiral($array);
    $arrayOut->arrayOut($sortSpiral->sortArrayType('ASC'));
    $arrayOut->arrayOut($sortSpiral->sortArrayType('DESC'));

    $sortVertical = new SortVertical($array);
    $arrayOut->arrayOut($sortVertical->sortArrayType('ASC'));
    $arrayOut->arrayOut($sortVertical->sortArrayType('DESC'));    */
     
    $out=ob_get_contents();
    ob_end_clean(); 
    
   // $arrayOut->writeToFile($out."<br><a href='../index.php'>back to index.php<a>");                
          
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