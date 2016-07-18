<?php

namespace dregan\tests;

use dregan\application\VerticalArray;
use PHPUnit_Framework_TestCase;
/**
 * Created by PhpStorm.
 * User: dregan
 * Date: 18.07.16
 * Time: 21:40
 */
class VerticalArrayTest extends PHPUnit_Framework_TestCase
{

    public function testVerticalArray()
    {

        $my = new VerticalArray(5);
        $this->assertInternalType('array', $my->sortArray());
        //$this->assertInternalType('array', $my->getTypes());

        $arrayGeneration = new VerticalArray(5);

        $arraySort = $arrayGeneration->sortArray();
        $expected = array(
            array(1, 6, 11, 16, 21),
            array(2, 7, 12, 17, 22),
            array(3, 8, 13, 18, 23),
            array(4, 9, 14, 19, 24),
            array(5, 10, 15, 20, 25)
        );
        $this->assertEquals($expected, $arraySort);

    }
}
