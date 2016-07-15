<?php
namespace arrays\app;
/**
 * Description of ArrayFactory
 * 
 * Factory for arrays
 * @var $type list of sort methods
 * @author dron
 */
class ArrayFactory 
{
    public $types = array(
        "Standart",
        "Vertical",
        "RevVertical",
        "Snake",
        "Spiral",
        "RevSpiral",
        "Diagonal"
    );
    public $class;
    public $number;
    
    public function GetTypes($number)
    {
        $this->number = $number;
        for ($i = 0, $n = count($this->types); $i < $n; $i++) {
            $this->types[$i] = "arrays\app\arr\\" . $this->types[$i];
        }

        return $this->types;
    }

    public function GetArray($type)
    {
        return new $type($this->number);
    }
}