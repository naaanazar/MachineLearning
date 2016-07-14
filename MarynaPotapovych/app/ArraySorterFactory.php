<?php

namespace liw\app; 

class ArraySorterFactory
{
    private static $SortTypes = array(
        "ForwardSort",
	    "BackSort"  
    );
    
    public function getSort($SortType)
    {
        $ClassName = ucfirst($SortType);
        $ObjectName = "liw\app\\" . $ClassName;
        
        return new $ObjectName(); 
    }
}