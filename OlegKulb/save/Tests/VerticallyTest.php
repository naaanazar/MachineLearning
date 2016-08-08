<?php

namespace ex\Tests;

use ex\app\sorts\Vertically;
use PHPUnit_Framework_TestCase;


class VerticallyTest extends PHPUnit_Framework_TestCase
{
    public function testArrayGeneration()
    {
        $arrayOriginal = array(
            array(1, 2, 3, 4),
            array(5, 6, 7, 8),
            array(9, 10, 11, 12),
            array(13, 14, 15, 16)
        );

        $arrayGeneration = new Vertically();
        $sortableArray = $arrayGeneration->process(3, $arrayOriginal);

        $expected = array(
            array(1, 5, 9, 13),
            array(2, 6, 10, 14),
            array(3, 7, 11, 15),
            array(4, 8, 12, 16)
        );

        sleep(5);
        $this->assertEquals($expected, $sortableArray);
    }



}
