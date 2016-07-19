<?php

namespace ex\Tests;

use ex\app\ArrayGeneration;
use PHPUnit_Framework_TestCase;


class SortingArraysTest extends PHPUnit_Framework_TestCase
{
    public function testArrayGeneration()
    {
        $arrayGeneration = new ArrayGeneration(3);
        $testArray = $arrayGeneration->generation();

        $expected = array(
            array(1, 2, 3, 4),
            array(5, 6, 7, 8),
            array(9, 10, 11, 12),
            array(13, 14, 15, 16)
        );

        sleep(5);
        $this->assertEquals($expected, $testArray);
    }



}
