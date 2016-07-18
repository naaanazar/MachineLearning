<?php

namespace ex\Tests;

use PHPUnit_Framework_TestCase;

class Test1 extends PHPUnit_Framework_TestCase
{
    public function test1()
    {
        $stack = 0;
        $this->assertEquals(0, $stack); //expected 0 -true
    }
    
    public function test2()
    {
        $stack = 12;
        $this->assertEquals(0, $stack); //expected 0 -false
    }

//    public function testDepends1()
//    {
//        $array = array();
//        $message = 'array not empty';
//        $this->assertEmpty($array, $message); // expected empty array -true
//
//        return 2323;
//    }
//
//    /**
//     * @depends testDepends1
//     */
//    public function testDepends2($number)
//    {
//        $this->assertEquals(2323, $number); // expected 1 -true
//    }

   
    public function testDepends3()
    {
        $this->assertEquals(2, 1); // expected 1 -false
    }

    public function testProducer21()
    {
        $this->assertTrue(true);

        return 'first';
    }
    
    public function testProducer22()
    {
        $this->assertTrue(true);

        return 'secong';
    }
    
    /**
     * @depends testProducer21
     * @depends testProducer22
     */
    public function testConsumerAB()
    {
        $this->assertEquals(
            array('first', 'second'),
            func_get_args()
        );
    }


}
