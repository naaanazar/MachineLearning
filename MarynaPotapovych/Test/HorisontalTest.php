<?php

namespace liw\Test;

use PHPUnit_Framework_TestCase;
use liw\app\HorisontalSortClass;

class HorisontalTest extends PHPUnit_Framework_TestCase
{
    protected $fixture;
    protected function setUp()
    {
        $this->fixture = new HorisontalSortClass(); 
    }

    protected function tearDown()
    {
        $this->fixture = NULL;
    }

    public function testEqual()
    {
        $expectedArray = array(
            array(1, 2, 3, 4, 5),
            array(6, 7, 8, 9, 10),
            array(11, 12, 13, 14, 15),
            array(16, 17, 18, 19, 20),
            array(21, 22, 23, 24, 25),
        );
        $this->assertEquals($expectedArray, $this->fixture->sortArr());
    }
    
   
}
