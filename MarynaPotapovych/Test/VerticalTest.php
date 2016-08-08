<?php

namespace liw\Test;

use PHPUnit_Framework_TestCase;
use liw\app\VerticalSortClass;

class VerticalTest extends PHPUnit_Framework_TestCase
{
    protected $fixture;
    
    protected function setUp()
    {
        $this->fixture = new VerticalSortClass(); 
    }

    protected function tearDown()
    {
        $this->fixture = NULL;
    }
       public function testEqual()
    {
        $expectedArray1 = array(
            array(1, 6, 11, 16, 21),
            array(2, 7, 12, 17, 22),
            array(3, 8, 13, 18, 23),
            array(4, 9, 14, 19, 24),
            array(5, 10, 15, 20, 25),
        );
        
        $this->assertEquals($expectedArray1, $this->fixture->sortArr());
    }
    
     public function testEqual1()
    {
        $expectedArray2 = array(
            array(25, 20, 15, 10, 5),
            array(24, 19, 14, 9, 4),
            array(23, 18, 13, 8, 3),
            array(22, 17, 12, 7, 2),
            array(21, 16, 11, 6, 1),
        );
        
        $this->fixture->flag = TRUE;
        $this->assertEquals($expectedArray2, $this->fixture->sortArr());
    }
    
    

}
