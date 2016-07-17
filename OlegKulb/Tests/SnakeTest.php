<?php

namespace ex\Tests;

use ex\app\sorts\Snake;
use PHPUnit_Framework_TestCase;


class SnakeTest extends PHPUnit_Framework_TestCase
{
    public function testArrayGeneration()
    {
        $arrayOriginal = array(
            array(1, 2, 3, 4),
            array(5, 6, 7, 8),
            array(9, 10, 11, 12),
            array(13, 14, 15, 16)
        );

        $arrayGeneration = new Snake();
        $sortableArray = $arrayGeneration->process(3, $arrayOriginal);
        
        $expected = array(
            array(1, 2, 3, 4),
            array(8, 7, 6, 5),
            array(9, 10, 11, 12),
            array(16, 15, 14, 13)
        );

        $this->assertEquals($expected, $sortableArray);
    }



}
