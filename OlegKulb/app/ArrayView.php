<?php
namespace ex\app;

class ArrayView
{
    public function viewSortArray($arrays, $arraySize)
    {
        echo "<table border='1'>";
        
        for($i = 0; $i <= $arraySize; $i++) {
            echo "<tr>";
            
            for($i2 = 0; $i2 <= $arraySize; $i2++) {
                echo "<td>". $arrays[$i][$i2] . "</td>";
            }
            
            echo "</tr>"; 
        } 
        
        echo "</table><hr /><br />";
    }
}