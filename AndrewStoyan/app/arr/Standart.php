<?php
namespace arrays\app\arr;
/**
 * Description of Standart
 *
 * @author dron
 */
use arrays\app\arr\out\OutPut;

class Standart extends ArrayBase
{
    public $array;
    protected $counter;
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
        echo "Standart method";

        $this->counter = 1;

        for ($i = 0; $i < $this->number; $i++) {
            for ($j = 0; $j < $this->number; $j++) {
                $this->array[$i][$j] = $this->counter++;
            }
        }
    }
}
