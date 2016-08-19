<?php
namespace arrays\app\arr;
/**
 * Description of Vertical
 *
 * @author dron
 */
use arrays\app\arr\out\OutPut;
class Vertical extends ArrayBase
{
    public $array;
    private $counter;
    public $number;

    public function __construct($number, $type) {
        $this->number = $number;
        $this->type = $type;
    }

    public function Display()
    {
        OutPut::OutPutArray($this->array, $this->number);
    }

    public function Feel()
    {
        echo "Vertical method";
        $this->counter = 1;

        for ($j = 0; $j < $this->number; $j++) {
            for ($i = 0; $i < $this->number; $i++) {
                $this->array[$i][$j] = $this->counter++;
            }
        }
    }
}
