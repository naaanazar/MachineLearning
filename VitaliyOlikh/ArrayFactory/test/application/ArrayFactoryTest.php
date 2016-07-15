<?php
namespace project\test\application;

use project\application\ArrayFactory;
use PHPUnit_Framework_TestCase;

class ArrayFactoryTest extends PHPUnit_Framework_TestCase
{
    public function testEmpty()
    {
        $stack = array();
        $this->assertEmpty($stack);

        return $stack;
    }
}
