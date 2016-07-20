<?php

namespace arr\tests\app;

use PHPUnit_Framework_TestCase;
use arr\app\ArraysFactory;
/**
 * Description of ArraysFactoryTest
 *
 * @author Nazar
 */
class ArraysFactoryTest extends PHPUnit_Framework_TestCase
{
    protected $factory;

    public function setUp()
    {
        $this->factory = new ArraysFactory();
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
        $sorterObject = $this->factory->getSorter($type);
        $expected = '\arr\app\sorters\\' . $type;
        $this->assertInstanceOf($expected, $sorterObject);
    }

    public function providerSorterTypes()
    {
        return array(
            array("SnakeSort"),
            array("StraightSort"),
            array("VerticalSort")
        );
    }

    /**
    * @expectedException Exception
    * @expectedExceptionMessage Type doesn't exists!
    */
    public function testGetSorterException()
    {
        $this->factory->getSorter("aaaa");
    }
    
}
