<?php

/**
 * Description of SnakeSortTest
 *
 * @author Nazar
 */

namespace arr\tests\app\sortersTest;

use PHPUnit_Framework_TestCase;
use arr\app\sorters\SnakeSort;

class SnakeSortTest extends PHPUnit_Framework_TestCase
{
    protected $sortObject;

    protected function setUp()
    {
        $this->sortObject = new SnakeSort();
    }

    protected function tearDown()
    {
        $this->sortObject = NULL;
    }

    public function testObjectCreating()
    {
        $this->assertNotNull($this->sortObject);
    }

    /**
    * @dataProvider providerArrays
    */
    public function testConvertToOneDimension($a)
    {        
        $this->assertInternalType("array", $this->sortObject->convertToOneDimension($a));
    }

    public function providerArrays()
    {
        $arr1 = array(
            array(1, 2, 3, 4, 5),
            array(1, 2, 3, 4, 5),
            array(1, 2, 3, 4, 5),
            array(1, 2, 3, 4, 5),
            array(1, 2, 3, 4, 5),
        );

        $arr2 = array(
            array(1, 2, 3, 4, 5),
            array(6, 7, 8, 9, 10),
            array(11, 12, 13, 14, 15),
            array(16, 17, 18, 19, 20),
            array(21, 22, 23, 24, 25),
        );

        $arr3 = array(
            array(1, 2, 3, 4, 5),
            array(6, 7, 8, 9, 10),
            array(11, 12, 13, 14, 15),
            array(16, 17, 18, 19, 20),
            array(21, 22, 23, 24, 25),
            array(21, 22, 23, 24, 25),
            array(1, 2, 3, 4, 5),
            array(6, 7, 8, 9, 10)
        );

        return array(
            array($arr1),
            array($arr2),
            array($arr3)
        );
    }
}
