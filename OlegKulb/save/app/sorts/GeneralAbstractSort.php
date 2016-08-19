<?php

namespace ex\app\sorts;

abstract class GeneralAbstractSort
{
    protected $arraySize;
    protected $arrayForSorting;

    private function setUp($arraySize, $arrayForSorting)
    {
        $this->arraySize = $arraySize;
        $this->arrayForSorting = $arrayForSorting;
    }

    public function process($arraySize, $arrayForSorting)
    {
        $this->setUp($arraySize, $arrayForSorting);
        
        return $this->sort();
    }

    abstract protected function sort();
}
