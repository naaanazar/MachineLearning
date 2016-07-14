<?php

namespace ex\app;

class ArrayView
{
    public function printArray()
    {
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
