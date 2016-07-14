<?php
namespace arrays\app\arr;
/**
 * Description of Snake
 *
 * @author dron
 */
use arrays\app\arr\out\OutPut;
class Snake extends ArrayBase
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
        echo "Snake method";
        $this->counter = 1;

        for ($i = 0; $i < $this->number; $i++) {
            if ($i % 2 == 0){
                for ($j = 0; $j < $this->number; $j++) {
                    $this->array[$i][$j] = $this->counter++;
                }
            } else {
                for ($j = $this->number - 1; $j >= 0; $j--) {
                    $this->array[$i][$j] = $this->counter++;
                }
            }
        }
    }

}
