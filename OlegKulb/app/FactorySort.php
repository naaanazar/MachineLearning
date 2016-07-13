<?php

namespace ex\app;

use ex\app\SortCreator;

class FactorySort
{
    public static function factorySort($method, $size)
    {
        $sortCreator = new SortCreator($size);
        $arrayOriginal = $sortCreator->getOriginalArray();
        $SortableArray = $sortCreator->getSort($method, $arrayOriginal);    
        
        echo "<table border='1'>";
        
        for($i = 0; $i <= $size; $i++) {
            echo "<tr>";
            
            for($i2 = 0; $i2 <= $size; $i2++) {
                echo "<td>". $SortableArray[$i][$i2] . "</td>";
            }
            
            echo "</tr>"; 
        } 
        
        echo "</table><hr /><br />";
    }
}
