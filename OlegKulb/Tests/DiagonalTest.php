<?php

namespace ex\Tests;

use ex\app\sorts\Diagonal;
use PHPUnit_Framework_TestCase;


class DiagonalTest extends PHPUnit_Framework_TestCase
{
    public function testArrayGeneration()
    {
        $arrayOriginal = array(
            array(1, 2, 3, 4),
            array(5, 6, 7, 8),
            array(9, 10, 11, 12),
            array(13, 14, 15, 16)
        );

        $arrayGeneration = new Diagonal();
        $sortableArray = $arrayGeneration->process(3, $arrayOriginal);

        $expected = array(
            array(1, 2, 4, 7),
            array(3, 5, 8, 11),
            array(6, 9, 12, 14),
            array(10, 13, 15, 16)
        );

        $this->assertEquals($expected, $sortableArray);
    }



}
