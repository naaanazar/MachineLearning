<?php

namespace liw\app;

class VerticalSortClass extends BaseSort
{
    public $flag = false;
    
    public function sortArr()
    {
        if (!$this->flag) {
            for ($i = 0; $i < 5; $i++) {
                for ($j = 0; $j < 5; $j++) {
                    echo $this->arr[$j][$i] . "&nbsp";
                    
                    if ($this->arr[$j][$i] < 10) {
                        echo "&nbsp;&nbsp;";
                    }
                }
                
                echo '<br />';
            }
            
            echo '------------------------------------------------';
            echo '<br />';
        } else {
            for ($i = 4; $i >= 0; $i--) {
                for ($j = 4; $j >= 0; $j--) {
                    echo $this->arr[$j][$i] . "&nbsp";
                    
                    if ($this->arr[$j][$i] < 10) {
                        echo "&nbsp;&nbsp;";
                    }
                }
                
                echo '<br />';
            }
            
            echo '------------------------------------------------';
            echo '<br />';
        }
    }
}
