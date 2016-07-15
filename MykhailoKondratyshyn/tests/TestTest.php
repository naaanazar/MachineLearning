<?php

/**
 * Created by PhpStorm.
 * User: space-user-1
 * Date: 15.07.16
 * Time: 14:17
 */
class TestTest extends PHPUnit_Framework_TestCase
{
    public function generateArrayTest()
    {
        $this->expectOutputString('generateArray');
        print 'this->arrayNew';

        $my = new NewArray();
        $this->assertEquals(8, $my->power(2, 3));
    }

//    public function testExpectBarActualBaz()
//    {
//        $this->expectOutputString('bar');
//        print 'baz';
//    }
}
