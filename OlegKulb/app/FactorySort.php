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

        $DBGW = DBGW::getInstance()->query('w');
        
        $arrayGeneration = new ArrayGeneration($size);
        $arrayOriginal = $arrayGeneration->generation();

        $class = '\\ex\\app\\sorts\\' . ucfirst($method);

        if ( !class_exists($class) ) {
            throw new Exception("Type does not exist");
        } else {
            $sort = new $class();
        }

        $sortableArray = $sort->process($size, $arrayOriginal);
        
        $output = new Output($size, $sortableArray);
        $output->arrayView();

        if ( !$file == NULL) {
            $output->printArrayInfile($file);
        }
    }
}
