<?php
    namespace sa\app;    
    
    class ArrayOut 
    {        
        public $file = 'tmp/array.html';      
        
        public function arrayOut($array)
        {            
            echo 
                "<div style='display: inline-block; margin:10px;'>
                    <table>
                        <caption>" . ArraySort::$sort_type1 . "</caption>";
            foreach ($array as $j => $value) {
                
                echo '<tr>';
                
                if (is_array($value))
                {
                    foreach ($value as $i => $value)
                    {
                        echo '<td>'. $value;
                    }
                    echo '</td></tr>';
                }                  
            }  
            echo 
                    '</table>
                </div>';               
        }  

        public function writeToFile($str)
        {  
            $s=file_put_contents($this->file, $str, LOCK_EX);
            echo $s;
            
        }
    }
