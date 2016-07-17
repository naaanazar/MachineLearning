<?php

namespace arrays\test;

use arrays\app\ArrayFactory;
use PHPUnit_Framework_TestCase;

/**
 *
 * @author dron
 */
class ArrayFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerTypes
     * @expectedException    Exception
     */
    public function testGetArray($type)
    {
        $test = new ArrayFactory();
        $test->number = 3;
        $test->GetArray($type);
    }

    public function providerTypes()
    {
        return array (
            array("arrays\app\arr\Standart"),
            array("arrays\app\arr\Vertical"),
            array("arrays\app\arr\NonVertical"),
            array("arrays\app\arr\Spiral")
        );
    }
}
