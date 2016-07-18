<?php
namespace arrays\test;

use arrays\app\arr\RevVertical;
use PHPUnit_Framework_TestCase;

class RevVerticalTest extends \PHPUnit_Framework_TestCase
{
    /**
    * @dataProvider providerFeel
    */

    public function testFeel($number, $array)
    {
        $test = new RevVertical($number);
        $test->Feel();
        $this->expectOutputString("Reverse Vertical method");
        $this->assertEquals($array, $test->array);
    }

    public function providerFeel ()
    {
        return array (
            array (
                3,
                array(
                    array(9, 6, 3),
                    array(8, 5, 2),
                    array(7, 4, 1)
                )
            ),
            array (
                4,
                array(
                    array(16, 12, 8, 4),
                    array(15, 11, 7, 3),
                    array(14, 10, 6, 2),
                    array(13, 9, 5, 1)
                )
            )
        );
    }
}
