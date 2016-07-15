<?php
namespace arrays\test;

use arrays\app\arr\RevSpiral;
use PHPUnit_Framework_TestCase;

class RevSpiralTest extends \PHPUnit_Framework_TestCase
{
    /**
    * @dataProvider providerFeel
    */

    public function testFeel($number, $array)
    {
        $test = new RevSpiral($number);
        $test->Feel();
        $this->assertEquals($array, $test->array);
    }

    public function providerFeel ()
    {
        return array (
            array (
                3,
                array(
                    array(9, 8, 7),
                    array(2, 1, 6),
                    array(3, 4, 5)
                )
            ),
            array (
                4,
                array(
                    array(16, 15, 14, 13),
                    array(5, 4, 3, 12),
                    array(6, 1, 2, 11),
                    array(7, 8, 9, 10)
                )
            )
        );
    }
}
