<?php
namespace app;



ini_set('error_reporting', E_ALL);
ini_set('display_errors',1);
ini_set('display_startup_errors', 1);

require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/Arrays.php';
require __DIR__.'/output.php';

if (isset($_POST['number']) && isset($_POST['submit'])) {
    $number = $_POST['number'];

    $array = new \Arrays();
    $arrayFinal = $array->ArrayFeel($number);
    
    \OutPut::OutPutArray($arrayFinal, $number);
    \OutPut::Offset(2);

    $arrayVert = $array->Vert($number);
    
    \OutPut::OutPutArray($arrayVert, $number);          
    \OutPut::Offset(2);
        
    $arrayVertRev = $array->VertRev($number);
    
    \OutPut::OutPutArray($arrayVertRev, $number);
    \OutPut::Offset(2);

    $arraySnake = $array->Snake($number);
    
    \OutPut::OutPutArray($arraySnake, $number);
    \OutPut::Offset(2);

    $arraySpiral = $array->SpiralFeel($number, 1);

    \OutPut::OutPutArray($arraySpiral, $number);
    \OutPut::Offset(2);

    $antiSpiral = $array->SpiralFeel($number, 2);

    \OutPut::OutPutArray($antiSpiral, $number);
    \OutPut::Offset(2);

    $arrayDiag = $array->DiagFeel($number);

    \OutPut::OutPutArray($arrayDiag, $number);

}