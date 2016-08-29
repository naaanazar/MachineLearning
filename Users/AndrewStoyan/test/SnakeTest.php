<?php
namespace arrays\test;

use arrays\app\arr\Snake;
use PHPUnit_Framework_TestCase;

class SnakeTest extends \PHPUnit_Framework_TestCase
{
    /**
    * @dataProvider providerFeel
    */

    public function testFeel($number, $array)
    {
        $test = new Snake($number);
        $test->Feel();
        $this->expectOutputString("Snake method");
        $this->assertEquals($array, $test->array);
    }

    public function providerFeel ()
    {
        return array (
            array (
                3,
                array(
                    array(1, 2, 3),
                    array(6, 5, 4),
                    array(7, 8, 9)
                )
            ),
            array (
                4,
                array(
                    array(1, 2, 3, 4),
                    array(8, 7, 6, 5),
                    array(9, 10, 11, 12),
                    array(16, 15, 14, 13)
                )
            )
        );
    }
}
