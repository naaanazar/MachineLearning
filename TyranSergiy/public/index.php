 <?php

 error_reporting(E_ALL);
ini_set('display_errors', 'On');
require __DIR__."/../vendor/autoload.php";
use app\Figure\Matrix;
use app\Factory\SortFactory;
use app\Sorter\BasicSorter;


  
  
if( isset($_POST['Size']) && isset($_POST['type'])){
  
    if($_POST['Size']<=16){
    
    $size = $_POST['Size'];
    $type = $_POST['type'];
    
    
 $matrix = new Matrix($size);
 $sortObj = SortFactory::getSort($type);
 $initialMatrix = $matrix->getArray();
 
  $matrix->setArray( $sortObj->sort( $matrix->getArray() ) );
  
  $array = $matrix->getArray();
  
    }
}



include 'view/index.php';

unset($matrix);
