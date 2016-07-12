<?php
namespace ex\app;

class GenerationArray
{
    protected $arrayOriginal;
    protected $arraySize;

    function __construct($size)
    {
        for($i = 0, $value = 1; $i <= $size; $i++) {
            for($i2 = 0; $i2 <= $size; $i2++) {
                $this->arrayOriginal[$i][$i2] = $value++;
            }
        } 
        $this->arraySize = $size;
    }
}
