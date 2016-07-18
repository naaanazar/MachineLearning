<?php

namespace arr\tests\app\sortersTest;

use PHPUnit_Framework_TestCase;
use arr\app\sorters\StraightSort;


/**
 * Description of StraightSortTest
 *
 * @author Nazar
 */
class StraightSortTest extends PHPUnit_Framework_TestCase
{
    protected $sortObject;
    
    public function setUp()
    {
        $this->sortObject = new StraightSort();
    }

    public function tearDown()
    {
        $this->sortObject = NULL;
    }

    public function testSortArray()
    {
        $expectedArray = array(
            array(1, 2, 3, 4, 5),
            array(6, 7, 8, 9, 10),
            array(11, 12, 13, 14, 15),
            array(16, 17, 18, 19, 20),
            array(21, 22, 23, 24, 25),
        );
        
        $this->assertEquals($expectedArray, $this->sortObject->sortArray());
    }
}
