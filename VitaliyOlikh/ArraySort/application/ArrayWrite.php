<?php
namespace application;



ini_set('error_reporting', E_ALL);
ini_set('display_errors',1);
ini_set('display_startup_errors', 1);

require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/ArraySort.php';
require __DIR__.'/ArrayOutput.php';

if (isset($_POST['number']) && isset($_POST['submit'])) {
    $number = $_POST['number'];

    $array = new \ArraySort();
    $arrayFinal = $array->ArrayFeel($number);
    
    \ArrayOutput::OutPutArray($arrayFinal, $number);
    \ArrayOutput::Offset(2);

    $arrayVert = $array->Vert($number);
    
    \ArrayOutput::OutPutArray($arrayVert, $number);          
    \ArrayOutput::Offset(2);
        
    $arrayVertRev = $array->VertRev($number);
    
    \ArrayOutput::OutPutArray($arrayVertRev, $number);
    \ArrayOutput::Offset(2);

    $arraySnake = $array->Snake($number);
    
    \ArrayOutput::OutPutArray($arraySnake, $number);
    \ArrayOutput::Offset(2);

    $arraySpiral = $array->SpiralFeel($number, 1);

    \ArrayOutput::OutPutArray($arraySpiral, $number);
    \ArrayOutput::Offset(2);

    $antiSpiral = $array->SpiralFeel($number, 2);

    \ArrayOutput::OutPutArray($antiSpiral, $number);
    \ArrayOutput::Offset(2);

    $arrayDiag = $array->DiagFeel($number);

    \ArrayOutput::OutPutArray($arrayDiag, $number);

}