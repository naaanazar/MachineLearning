<?php
namespace dregan\application;

use Exception;

class ArrayFactory
{

    public $types = array(
        "VerticalArray",
        "UnVerticalArray",
        "HorisontalArray",
    );

    public function getTypes()
    {
        return $this->types;
    }

    public function getArray($type, $size)
    {
        if (in_array($type, $this->types)) {
            $className = '\dregan\application\\' . $type;
            return new $className($size);
        } else {
            throw new Exception("Type does not exist");
        }
    }
}