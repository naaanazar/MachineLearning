<?php
	namespace app;

	ini_set('error_reporting', E_ALL);
	ini_set('display_errors',1);
	ini_set('display_startup_errors', 1);

    require __DIR__.'/../vendor/autoload.php';

    if (isset($_POST['number']) && isset($_POST['submit'])) {
        $number = $_POST['number'];

        $array = new Array();
        $arrayFinal = $array->ArrayFeel($number);

        OutPut::OutPutArray($arrayFinal, $number);
        OutPut::Vidstup(2);

        OutPut::Vert($arrayFinal, $number);          
        OutPut::Vidstup(2);
        
        OutPut::VertRev($arrayFinal, $number);         
        OutPut::Vidstup(2);

        OutPut::Snake($arrayFinal, $number);
		OutPut::Vidstup(2);

        $arraySpiral = $array->SpiralFeel($number, 1);

        OutPut::OutPutArray($arraySpiral, $number);
        OutPut::Vidstup(2);

       	$antiSpiral = $array->SpiralFeel($number, 2);

       	OutPut::OutPutArray($antiSpiral, $number);
        OutPut::Vidstup(2);

        $arrayDiag = $array->DiagFeel($number);

        OutPut::OutPutArray($arrayDiag, $number);

    }