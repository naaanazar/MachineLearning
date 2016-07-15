<?php
namespace arrays\test;

use arrays\app\arr\Vertical;
use PHPUnit_Framework_TestCase;

class VerticalTest extends \PHPUnit_Framework_TestCase
{
    /**
    * @dataProvider providerFeel
    */

    public function testFeel($number, $array)
    {
        $test = new Vertical($number);
        $test->Feel();
        $this->assertEquals($array, $test->array);
    }

    public function providerFeel ()
    {
        return array (
            array (
                3,
                array(
                    array(1, 4, 7),
                    array(2, 5, 8),
                    array(3, 6, 9)
                )
            ),
            array (
                4,
                array(
                    array(1, 5, 9, 13),
                    array(2, 6, 10, 14),
                    array(3, 7, 11, 15),
                    array(4, 8, 12, 16)
                )
            )
        );
    }
}
