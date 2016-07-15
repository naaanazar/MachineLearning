<?php
namespace arrays\test;

use arrays\app\arr\Standart;
use PHPUnit_Framework_TestCase;

class StandartTest extends \PHPUnit_Framework_TestCase
{
    /**
    * @dataProvider providerFeel
    */

    public function testFeel($number, $array)
    {
        $test = new Standart($number);
        $test->Feel();
        $this->assertEquals($array, $test->array);
    }

    public function providerFeel ()
    {
        return array (
            array (
                3,
                array(
                    array(1, 2, 3),
                    array(4, 5, 6),
                    array(7, 8, 9)
                )
            ),
            array (
                4,
                array(
                    array(1, 2, 3, 4),
                    array(5, 6, 7, 8),
                    array(9, 10, 11, 12),
                    array(13, 14, 15, 16)
                )
            )
        );
    }
}
