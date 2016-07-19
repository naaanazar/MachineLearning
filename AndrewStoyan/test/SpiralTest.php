<?php
namespace arrays\test;

use arrays\app\arr\Spiral;
use PHPUnit_Framework_TestCase;

class SpiralTest extends \PHPUnit_Framework_TestCase
{
    /**
    * @dataProvider providerFeel
    */

    public function testFeel($number, $array)
    {
        $test = new Spiral($number);
        $test->Feel();
        $this->expectOutputString("Spiral method");
        $this->assertEquals($array, $test->array);
    }

    public function providerFeel ()
    {
        return array (
            array (
                3,
                array(
                    array(1, 2, 3),
                    array(8, 9, 4),
                    array(7, 6, 5)
                )
            ),
            array (
                4,
                array(
                    array(1, 2, 3, 4),
                    array(12, 13, 14, 5),
                    array(11, 16, 15, 6),
                    array(10, 9, 8, 7)
                )
            )
        );
    }
}
