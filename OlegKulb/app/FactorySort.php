<?php

namespace ex\app;

use ex\app\ArrayGeneration;

class FactorySort
{
    public static function factorySort($method, $size, $file = NULL)
    {
        $arrayGeneration = new ArrayGeneration($size);
        $arrayOriginal = $arrayGeneration->generation();

        $class = '\\ex\\app\\sorts\\' . ucfirst($method);
        
        $sort = new $class();
        $sortableArray = $sort->process($size, $arrayOriginal);
        
        $output = new Output($size, $sortableArray);
        $output->arrayView();

        if( !$file == NULL) {
            $output->printArrayInfile($file);
        }
        

        
    }
}
