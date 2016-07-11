 <?php
     require_once '../app/classes/class.create_array.php';  
     require_once '../app/classes/class.array_sort.php'; 
     require_once '../array_conf.php';
    if (isset($_POST['w1']) && isset($_POST['h1']) ){
        $cr_ar = new app\classes\CreateArray;
        $array = $cr_ar->crArray($_POST['h1'], $_POST['w1'], $_POST['type']);   
    } else {
        $array = $default_array;
    }
    
    $sort_asc= new app\classes\ArraySort($array);
    ob_start();           

    $sort_asc->arrayOut($sort_asc->sortArray('ASC'));
    $sort_asc->arrayOut($sort_asc->sortArray('DESC'));

    $sort_asc->arrayOut($sort_asc->zipper('ASC'));
    $sort_asc->arrayOut($sort_asc->zipper('DESC'));

    $sort_asc->arrayOut($sort_asc->rotationArray('ASC'));
    $sort_asc->arrayOut($sort_asc->rotationArray('DESC'));

    $sort_asc->arrayOut($sort_asc->spiral('ASC'));
    $sort_asc->arrayOut($sort_asc->spiral('DESC'));
    $out=ob_get_contents();
    $sort_asc->writeToFile($out."<br><a href='index.php'>back to index.php<a>");
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
        <p>
        Enter array size if you want to change the size of the array
        <form action ='index.php' method='post'>
            <input type='number' name='w1' value="" placeholder='width' required> 
            <input type='number' name='h1' value="" placeholder='height' required><br>            
            <input type='radio' name='type' value='successively' checked>successively<br>
            <input type='radio' name='type' value='random'>random<br>
            <input type='submit' value='reload'> 
           
            
        </form>
        <a href='array.html'>Open the recorded file</a>
       
    </body>
</html>