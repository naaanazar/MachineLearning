<?php

 

namespace sa\app;



class FactoryArray 
{    
    public static function sort($type1, $array)
            
    {        
       switch ($type1) {
            case 'Horizontal':
                return new SortHorizontal($array);
                break;
            
            case 'Zipper':
                return new SortZipper($array);
                break;

            default:
                break;
        }
       // $type = '\\app\\'."Sort".ucfirst($type);
        
        return new SortHorizontal($array);    
    }
   
}
