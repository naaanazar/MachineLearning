<?php

namespace ex\app;

class ArrayGeneration
{
    private $arraySize;
    
    public function __construct($arraySize)
    {
        $this->arraySize = $arraySize;
    }

    public function generation()
    {
        for ($i = 0, $value = 1; $i <= $this->arraySize; $i++) {
            for($i2 = 0; $i2 <= $this->arraySize; $i2++) {
                $arrayOriginal[$i][$i2] = $value++;
            }
        }
        return $arrayOriginal;
    }
}
