<?php
namespace app\Factory;

abstract class SortFactory {
   
    
    public static function getSort($type = "Horizontal"){
        
        
        $type = "app\\Sorter\\".ucfirst($type)."Sort";
        
        return new $type;
        
        
    }
}
