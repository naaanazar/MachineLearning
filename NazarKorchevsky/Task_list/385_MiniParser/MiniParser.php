<?php

class MiniParser
{
    public $ar=array();
    private $i = 0;
    private $open = 0;
    private $close = 0;

    public function parse($str)
    {
        $number = '';
        if (is_numeric($str)) {
            return $str;
        }

        while ($this->i < strlen($str)){
          
            if (ctype_digit ($str[$this->i])) {
                $number .=$str[$this->i];

            } else {
             
                if ($number != '') {
                    $this->ar[$this->open][] = $number;
                    $number = '';                    
                }               

                if ($str[$this->i] == '[') {
                    $this->open++;
                }

                if ($str[$this->i] == ']') {
                    $this->open--;
                }
            }
        $this->i++;
        }      
         
        if (isset($this->ar)) {
            return $this->ar;
        } 
    }
    

    public function out($arr)
    {
        if (is_array($arr)) {

            foreach($arr as $k=>$val){
                echo '<ul>';

                foreach ($val as $key => $value) {
                    echo "<li>" .$value . '</li>';
                }
            }
            echo '</ul>';
        } else {
            echo $arr;
        }
    }

}
