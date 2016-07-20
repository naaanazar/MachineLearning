<?php

namespace ex\Tests;

use PHPUnit_Framework_TestCase;

class MockTest extends PHPUnit_Framework_TestCase{
    public function testFirstMock()
    {
        $generalArray = array(
            array(1, 2, 3, 4),
            array(5, 6, 7, 8),
            array(9, 10, 11, 12),
            array(13, 14, 15, 16)
        );

        $mock = $this->getMock('\\ex\\app\\sorts\\Snake', array('process', 'setUp', 'sort'));
        
//        $this->assertInstanceOf('\\ex\\app\\sorts\\Snake', $mock);
        
        $mock->expects($this->once())
                ->method('process')
                ->with(3, $generalArray);
//        $mock->expects($this->at(2))->method('setUp');
//        $mock->expects($this->at(3))->method('sort');
        $mock->process();



    }
}
//\\ex\\app\\sorts\\