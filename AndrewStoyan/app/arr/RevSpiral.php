<?php
namespace arrays\app\arr;

/**
 * Description of RevSpiral
 *
 * @author dron
 */
use arrays\app\arr\out\OutPut;
class RevSpiral extends ArrayBase
{
    public $array;
    private $counter;
    public $number;

    public function __construct($number) {
        $this->number = $number;
    }

    public function Display()
    {
        OutPut::OutPutArray($this->array, $this->number);
    }

    public function Feel()
    {
        echo "Reverse Spiral method";
        $this->counter = $this->number * $this->number;
        $i = $j = 0;
        $right = $this->number - 1;
        $left = 0;
        
        for ($n = 0; $n < $this->number * $this->number; ++$n) {

           
            $this->array[$i][$j] = $this->counter--;
            
            if (($i == ($left + 1)) && ($j == $left)) {
                $right--;
                $left++;
            }

            if (($j == $right) && ($i < $right)) {
                $i++;
                continue;
            }

            if (($j < $right) && ($i == $left)) {
                $j++;
                continue;
            }

            if (($i == $right) && ($j > $left)) {
                $j--;
                continue;
            }

            if (($j == $left) && ($i > $left)) {
                $i--;
                continue;
            }
        }
    }
}
