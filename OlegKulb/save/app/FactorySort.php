<?php

namespace ex\app;

use Exception;
use ex\app\ArrayGeneration;
use ex\app\Database\DBGW;
use PDO;

class FactorySort
{
    public static function factorySort($method, $size, $file = NULL)
    {

        
        
        $arrayGeneration = new ArrayGeneration($size);
        $arrayOriginal = $arrayGeneration->generation();

        $class = '\\ex\\app\\sorts\\' . ucfirst($method);

        if ( !class_exists($class) ) {
            throw new Exception("Type does not exist");
        } else {
            $sort = new $class();
        }

        $sortableArray = $sort->process($size, $arrayOriginal);

        $arrayToString = gzcompress( serialize($sortableArray) );

//        echo '<pre>';
//        print_r( gzuncompress($arrayToString) );
//        die();

        $DBGW = DBGW::getInstance()->query($method, $arrayToString);

        $output = new Output($size, $sortableArray);
        $output->arrayView();

        if ( !$file == NULL) {
            $output->printArrayInfile($file);
        }
    }
}
