<?php
require_once 'array_conf.php';
class array_sort{
            public $array;
            public $sort = 'ASC';
            public $file = 'array.html';
            public $out=[];
            public $string;
            public $sort_type;
        
            
            function __construct($array){
                $this->array = $array;                 
            }
            public function sort_array(){
                $this->sort_type = 'Sort  ' . $this->sort;
                $ar = [];
                $n = max( array_map( 'count',  $this->array ) );
                foreach ($this->array as $j => $value) {
                    $ar= array_merge($ar, $value);                
                }  
                if ($this->sort == 'DESC'){
                    rsort($ar);
                }
                elseif($this->sort == 'ASC'){
                    sort($ar);
                }
                $this->array=array_chunk($ar, $n);                
            }   
            
            public function zipper(){
                $this->sort_array();
                $this->sort_type = 'Zipper  ' . $this->sort;
                if ($this->sort == 'ASC'){
                    $f=1; 
                }
                if ($this->sort == 'DESC'){
                    $f=2; 
                }
                foreach ($this->array as $key => $value) {
                    if (is_array($value)){                    
                        $tmp=$this->array[$key]; 
                        if (($f % 2) == 0){
                            $this->array[$key] = array_reverse($tmp);
                        }
                        $f++;
                    }
                }
            } 
            public function rotation_matrix(){
                $this->sort_array();
                $this->sort_type = 'Rotate array  ' . $this->sort;
                array_unshift($this->array, null);
                $this->array = call_user_func_array('array_map', $this->array);
            }
                        
            public function array_out(){
                ob_start();
                echo 
                    "<div style='display: inline-block; margin:10px;'>
                        <table>
                            <caption>".$this->sort_type ."</caption>";
                foreach ($this->array as $j => $value) {
                    echo '<tr>';
                    if (is_array($value)){
                        foreach ($value as $i => $value) {
                                echo '<td>'. $value;
                            }
                        echo '</td></tr>';
                    }
                  
                }  
                echo 
                        '</table>
                    </div>';
                $this->string=ob_get_contents();
                $this->out[]=$this->string;
                ob_get_clean();
                
            }  
            
            public function write_to_file(){    
                global $string ;
                foreach ($this->out as $key => $value) {
                    $string .= $value;
                }
                file_put_contents($this->file, $string, LOCK_EX);
            }
             
        
        }