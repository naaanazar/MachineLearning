<?php

namespace ex\app;

use Exception;
use ex\app\ArrayGeneration;

class FactorySort
{
    public static function factorySort($method, $size, $file = NULL)
    {
        $arrayGeneration = new ArrayGeneration($size);
        $arrayOriginal = $arrayGeneration->generation();

        $class = '\\ex\\app\\sorts\\' . ucfirst($method);

        if( !class_exists($class) ) {
            throw new Exception("Type does not exist");
        }

        $sort = new $class();


        $sortableArray = $sort->process($size, $arrayOriginal);
        
        $output = new Output($size, $sortableArray);
        $output->arrayView();

        if( !$file == NULL) {
            $output->printArrayInfile($file);
        }
    }
}
