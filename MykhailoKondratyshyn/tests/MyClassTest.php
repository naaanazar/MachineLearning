<?php

namespace dregan\tests;

use dregan\application\MyClass;
use PHPUnit_Framework_TestCase;

/**
 * Created by PhpStorm.
 * User: space-user-1
 * Date: 15.07.16
 * Time: 14:30
 */
class MyClassTest extends PHPUnit_Framework_TestCase
{
    public function testPower()
    {
        $my = new MyClass();
        $this->assertEquals(8, $my->power(2, 3));
    }
}
