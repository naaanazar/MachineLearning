<?php
/**
 * Created by PhpStorm.
 * User: dregan
 * Date: 18.07.16
 * Time: 21:48
 */

namespace dregan\tests;

use dregan\application\UnVerticalArray;
use PHPUnit_Framework_TestCase;
class UnVerticalArrayTest extends PHPUnit_Framework_TestCase
{
    public function testUnVerticalArray()
    {

        $my = new UnVerticalArray(5);
        $this->assertInternalType('array', $my->sortArray());


        $arrayGeneration = new UnVerticalArray(5);

        $arraySort = $arrayGeneration->sortArray();
        $expected = array(
            array(25, 20, 15, 10, 5),
            array(24, 19, 14, 9, 4),
            array(23, 18, 13, 8, 3),
            array(22, 17, 12, 7, 2),
            array(21, 16, 11, 6, 1)
        );
        $this->assertEquals($expected, $arraySort);

    }
}
