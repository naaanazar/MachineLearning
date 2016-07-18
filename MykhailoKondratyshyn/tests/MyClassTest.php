<?php

namespace dregan\tests;

use dregan\application\MyClass;
use PHPUnit_Framework_TestCase;


class MyClassTest extends PHPUnit_Framework_TestCase
{
    public function testPower()
    {
        $my = new MyClass();
        $this->assertEquals(8, $my->power(2, 3));
    }
}
