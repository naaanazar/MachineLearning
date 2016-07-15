<?php
namespace arrays\test;

use arrays\app\arr\Diagonal;
use PHPUnit_Framework_TestCase;

class DiagonalTest extends \PHPUnit_Framework_TestCase
{
    /**
    * @dataProvider providerFeel
    */

    public function testFeel($number, $array)
    {
        $test = new Diagonal($number);
        $test->Feel();
        $this->assertEquals($array, $test->array);
    }

    public function providerFeel ()
    {
        return array ( 
            array (
                3,
                array(
                    array(1, 2, 4),
                    array(3, 5, 7),
                    array(6, 8, 9)
                )
            ),
            array (
                4, 
                array(
                    array(1, 2, 4, 7),
                    array(3, 5, 8, 11),
                    array(6, 9, 12, 14),
                    array(10, 13, 15, 16)
                )
            )
        );
    }
}
