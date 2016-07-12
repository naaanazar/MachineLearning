 <?php
 
    ini_set('error_reporting', E_ALL);
	ini_set('display_errors',1);
	ini_set('display_startup_errors', 1);
  
    require_once '../app/array_conf.php';
    require __DIR__ . '/../vendor/autoload.php';
    
    use sa\app\ArraySort;
    use sa\app\CreateArray; 
    use sa\app\ArrayOut; 
 
    if (isset($_POST['w1']) && isset($_POST['h1']) ){
        $cr_ar = new CreateArray;
        $array = $cr_ar->crArray($_POST['h1'], $_POST['w1'], $_POST['type']);   
    } else {
        $array = $default_array;
    }
    
    $sort_asc= new ArraySort($array);
    $arrayOut = new ArrayOut($array);
    ob_start();           

    $arrayOut->arrayOut($arrayOut->sortArray('ASC'));
    $arrayOut->arrayOut($arrayOut->sortArray('DESC'));

    $arrayOut->arrayOut($arrayOut->zipper('ASC'));
    $arrayOut->arrayOut($arrayOut->zipper('DESC'));

    $arrayOut->arrayOut($arrayOut->rotationArray('ASC'));
    $arrayOut->arrayOut($arrayOut->rotationArray('DESC'));

    $arrayOut->arrayOut($arrayOut->spiral('ASC'));
    $arrayOut->arrayOut($arrayOut->spiral('DESC'));
    
     
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