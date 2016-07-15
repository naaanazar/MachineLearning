<?php

namespace liw;
/**
 * Description of ClassArr
 *
 * @author Maryna
 */

class ClassArr 
{
    public $arr = array( array(1, 2, 3, 4, 5 ), 
                        array(6, 7, 8, 9, 10), 
                        array(11, 12, 13, 14, 15),
                        array(16, 17, 18, 19, 20),
                        array(21, 22, 23, 24, 25)); 
   
                   
    public function OutArr()
    {
        for ($i = 0; $i < 5; $i++) 
        { 
            for ($j=0; $j < 5; $j++) 
            { 
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

    public function ForwardSort()
    {
        for ($i = 0; $i < 5; $i++) 
        { 
            for ($j=0; $j <5; $j++) 
            { 
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
    
    public function BackSort()
    {
        
        for ($i = 4; $i >= 0; $i--) 
        { 
            for ($j = 4; $j >= 0; $j--) 
            {
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

 
   

