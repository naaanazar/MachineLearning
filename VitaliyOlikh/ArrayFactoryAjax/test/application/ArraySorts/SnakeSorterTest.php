<?php

namespace project\test\application\ArraySorts;

use PHPUnit_Framework_TestCase;
use project\application\ArraySorts\SnakeSorter;

class SnakeSorterTest extends PHPUnit_Framework_TestCase
{
    public function testArrayFeel()
    {
        $baseArray = new SnakeSorter();

        $this->assertEquals(
                array(
                    array(1, 2, 3, 4, 5,),
                    array(6, 7, 8, 9, 10),
                    array(11, 12, 13, 14, 15),
                    array(16, 17, 18, 19, 20),
                    array(21, 22, 23, 24, 25),                    
                ),
                $baseArray->arrayFeel(5));
    }
}
