<?php
    
    class ArraySort{

        public $array;
        public $sort = 'ASC';
        public $file = 'array.html';
        public $string;
        public $sort_type;
        


       function __construct($array)
        {
            $this->array = $array;                 
        }

        public function sortArray($sort)
        {            
            global $ar;
            global $n;
            $ar = [];
            $n = max( array_map( 'count',  $this->array ) );
            $this->sort_type = 'Sort  ' . $sort;
            foreach ($this->array as $j => $value)
            {
                $ar= array_merge($ar, $value);                
            }  
            if ($sort == 'DESC')
            {
                rsort($ar);
            }
            elseif($sort == 'ASC')
            {
                sort($ar);
            } 
            $sort_array=array_chunk($ar, $n);
            return $sort_array;
            
        }     
      

        public function zipper($sort)
        {
            $array=$this->sortArray($sort);           
            $this->sort_type = 'Zipper  ' . $sort;
            if ($sort == 'ASC')
            {
                $f=1; 
            }
            if ($sort == 'DESC')
            {
                $f=2; 
            }
            foreach ($array as $key => $value) {
                if (is_array($value))
                {                    
                    $tmp=$array[$key]; 
                    if (($f % 2) == 0)
                    {
                        $array[$key] = array_reverse($tmp);
                    }
                    $f++;
                }
            }
            return  $array;
        } 
        
        public function rotationArray($sort)
        {
            $array=$this->sortArray($sort);   
            $this->sort_type = 'Rotate array  ' . $sort;
            array_unshift($array, null);
            $array = call_user_func_array('array_map', $array);
            return $array;
        }
        
        public function spiral($sort)
        {
            global $ar;
            global $n;
           
            $array=$this->sortArray($sort);   
            $this->sort_type = 'spiral  ' . $sort;           
            $i = $j = 0;            
            $w = count($array);
            $right = $w - 1;
            $left = 0;
            $s = 0;            
            for ($k = 0; $k < $n * $w; ++$k) {
                $array[$i][$j] = $ar[$s++];
                if (($i == ($left + 1)) and ($j == $left)) { 
                    $right--;
                    $left++;
                } if (($j == $right) and ($i < $right)) { 
                    $i++;
                    continue;
                } 
                if (($j < $right) and ($i == $left)) {
                    $j++; 
                    continue;
                } 
                if (($i == $right) and ($j > $left)) { 
                    $j--;
                    continue;
                } 
                if (($j == $left) and ($i > $left)) {
                    $i--; 
                    continue;} 
            };
            return $array;
           
        }
        

        public function arrayOut($array)
        {            
            echo 
                "<div style='display: inline-block; margin:10px;'>
                    <table>
                        <caption>".$this->sort_type ."</caption>";
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

        public function writeToFile($str)
        {  
            file_put_contents($this->file, $str, LOCK_EX);
        }
    }