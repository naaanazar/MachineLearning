<?php

namespace liw\app;

class HorisontalSortClass extends BaseSort
{
    public function sortArr()
    {
        for ($i = 0; $i < 5; $i++) { 
            for ($j=0; $j < 5; $j++) { 
                echo $this->arr[$i][$j] . "&nbsp"; 
                
                if ($this->arr[$i][$j] < 10) {
                    echo "&nbsp;&nbsp;";
                }
            } 
            
            echo '<br />';
        }
        
        echo '------------------------------------------------'; 
        echo '<br />';
    }
}
