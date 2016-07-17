<?php

namespace liw\Test;

use PHPUnit_Framework_TestCase;
use liw\app\VerticalSortClass;

class VerticalTest extends PHPUnit_Framework_TestCase
{
    public function testExpectActual()
    {
        $this->expectOutputString('1, 6, 11, 16, 21');
        print '1, 6, 11, 16, 21';
    }

    public function testExpectActual1()
    {
        $this->expectOutputString('1, 6, 11, 16, 21');
        print '1, 6, 11, 17, 21';
    }
    public function testEquality()
    {
        $this->assertEquals(
                array(1, 6, 11, 16, 21), array(2, 7, 12, 17, 22,)
        );
    }

    public function testEquality1()
    {
        $this->assertEquals(
                array(2, 7, 12, 17, 22), array(2, 7, 12, 17, 22)
        );
    }

    public function testEquality2()
    {
        $this->assertEquals(
                array(3, 8, 13, 18, 23), array(2, 7, 12, 17, 22)
        );
    }

    public function testEquality3()
    {
        $this->assertEquals(
                array(4, 9, 14, 19, 24), array(4, 9, 14, 19, 24)
        );
    }

    public function testEquality4()
    {
        $this->assertEquals(
                array(5, 10, 15, 20, 25), array(5, 10, 15, 20, 25)
        );
    }
    
  

}
