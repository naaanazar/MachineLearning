<?php
namespace arrays\app\arr;
/**
 * Description of RevVertical
 *
 * @author dron
 */
use arrays\app\arr\out\OutPut;
class RevVertical extends ArrayBase
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
        echo "Reverse Vertical method";
        $this->counter = 1;

        for ($j = $this->number - 1; $j >= 0; $j--) {
            for ($i = $this->number - 1; $i >= 0; $i--) {
                $this->array[$i][$j] = $this->counter++;
            }
        }
    }
}
