<?php
    namespace sa\traits;
    
    trait ArrayOut
    {        
        public $file = OUT_FILE; 
        
        public function arrayOut($array)
        {            
            echo 
                "<div style='display: inline-block; margin:10px;'>
                    <table>
                        <caption>" . $this->sort_type . "</caption>";
            foreach ($array as $j => $value)
            {
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

        static function writeToFile($str)
        {  
            file_put_contents($file, $str, LOCK_EX);
        }
    }
