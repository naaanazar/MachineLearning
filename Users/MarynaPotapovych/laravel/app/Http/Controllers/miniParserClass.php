<?php


namespace App\Http\Controllers;


class miniParserClass
{

    public $string = "[123,[456,[789]]]";
    public $string2 = "";
    public $array = [];
  

    public function miniParse()
    {
    $a = 0;
    $b = 0;
        for ($i = 0; $i < strlen($this->string); $i++) {
            if (is_numeric($this->string[$i])) {
                $this->string2 = $this->string2 . $this->string[$i];
                
                if (!is_numeric($this->string[$i + 1])) {
                    $this->array[$a][$b] = $this->string2;
                    $this->string2 = '';
                    echo "<pre>";
                    print_r($this->array);
                }
            }
            if ($this->string[$i] == "[") {
                $a++;
            }
            if ($this->string[$i] == "]") {
                $b--;
                $a--;
            }
        }
    }

}
