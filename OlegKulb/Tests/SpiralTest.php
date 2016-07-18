<?php

namespace ex\Tests;

use ex\app\sorts\Spiral;
use PHPUnit_Framework_TestCase;


class SpiralTest extends PHPUnit_Framework_TestCase
{
    public function testArrayGeneration()
    {
        $arrayOriginal = array(
            array(1, 2, 3, 4),
            array(5, 6, 7, 8),
            array(9, 10, 11, 12),
            array(13, 14, 15, 16)
        );

        $arrayGeneration = new Spiral();
        $sortableArray = $arrayGeneration->process(3, $arrayOriginal);

        $expected = array(
            array(1, 2, 3, 4),
            array(12, 13, 14, 5),
            array(11, 16, 15, 6),
            array(10, 9, 8, 7)
        );

        $this->assertEquals($expected, $sortableArray);
    }



}
