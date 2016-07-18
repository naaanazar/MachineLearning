<?php

namespace liw\app; 

class ArraySorterFactory
{
    private static $SortTypes = array(
        "HorisontalSort",
	    "VerticalSort"  
    );
    
    public function getSort($SortType)
    {
        $ClassName = ucfirst($SortType);
        $ObjectName = "liw\app\\" . $ClassName;
        
        return new $ObjectName(); 
    }
}