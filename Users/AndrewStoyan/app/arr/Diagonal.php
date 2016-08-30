<?php
namespace arrays\app\arr;
/**
 * Description of Diagonal
 * Output diagonal array
 * @author dron
 */
use arrays\app\arr\out\OutPut;
class Diagonal extends ArrayBase
{
    private $x = 0;
    private $y = 0;
    private $counter = 1;
    public $array;
    public $number;

    public function __construct($number, $type) {
        $this->number = $number;
        $this->type = $type;
    }

    public function Feel()
    {
        echo "Diagonal method";
        for ($i = 0; $i < $this->number; $i++) {
            $this->x = 0;
            $this->y = $i;

            while ($this->y >= 0) {
               	$this->array[$this->x][$this->y] = $this->counter++;
                $this->x++;
                $this->y--;
            }
        }

        for ($i = 1; $i < $this->number; $i++) {
            $this->x = $i;
            $this->y = $this->number - 1;

            while ($this->x <= $this->number - 1) {
                $this->array[$this->x][$this->y] = $this->counter++;
                $this->x++;
                $this->y--;
            }
        }
    }

    public function Display()
    {
        OutPut::OutPutArray($this->array, $this->number);
    }

}
