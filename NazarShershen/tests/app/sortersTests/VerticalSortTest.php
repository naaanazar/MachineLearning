<?php

namespace arr\tests\app\sortersTest;

use PHPUnit_Framework_TestCase;
use arr\app\sorters\VerticalSort;

/**
 * Description of VerticalSortTest
 *
 * @author Nazar
 */
class VerticalSortTest extends PHPUnit_Framework_TestCase
{
    protected $sortObject;

    public function setUp()
    {
        $this->sortObject = new VerticalSort();
    }

    public function tearDown()
    {
        $this->sortObject = NULL;
    }

    public function testSortArrForward()
    {
        $expectedArray = array(
            array(1, 6, 11, 16, 21),
            array(2, 7, 12, 17, 22),
            array(3, 8, 13, 18, 23),
            array(4, 9, 14, 19, 24),
            array(5, 10, 15, 20, 25),
        );        
        $this->assertEquals($expectedArray, $this->sortObject->sortArray());
    }
    
    public function testSortArrBackward()
    {
        $expectedArray = array(
            array(25, 20, 15, 10, 5),
            array(24, 19, 14, 9, 4),
            array(23, 18, 13, 8, 3),
            array(22, 17, 12, 7, 2),
            array(21, 16, 11, 6, 1),
        );
                        
        $this->sortObject->flag = true;
        $this->assertEquals($expectedArray, $this->sortObject->sortArray());
    }
}
