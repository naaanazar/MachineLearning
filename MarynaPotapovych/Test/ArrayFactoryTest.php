<?php

namespace liw\Test;

use PHPUnit_Framework_TestCase;
use liw\app\ArraySorterFactory;

class ArrayFactoryTest extends PHPUnit_Framework_TestCase
{
    protected $factory;
    public function setUp()
    {
        $this->factory = new ArraySorterFactory();
    }
    public function tearDown()
    {
        $this->factory = NULL;
    }
    /**
    * @dataProvider providerSorterTypes
    */
    public function testGetSorter($type)
    {
        $sortObj = $this->factory->getSort($type);
        $expected = '\liw\app\\' . $type;
        $this->assertInstanceOf($expected, $sortObj);
    }
    public function providerSorterTypes()
    {
        return array(
            array("HorisontalSortClass"),
            array("VerticalSortClass")
        );
    }
}
