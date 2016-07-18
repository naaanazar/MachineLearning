<?php

namespace dregan\tests;

use dregan\application\ArrayFactory;
use PHPUnit_Framework_TestCase;
/**
 * Created by PhpStorm.
 * User: space-user-1
 * Date: 18.07.16
 * Time: 10:31
 */
class ArrayFactoryTest extends PHPUnit_Framework_TestCase
{


    /**
     * @expectedException        Exception
     * @expectedExceptionMessage Type does not exist
     */
    public function testExceptionHasRightMessage()
    {
        $factory = new ArrayFactory();
        $this->assertInstanceOf('\dregan\application\HorisontalArray', $factory->getArray('sontalArray', 5));
    }






    public function testArrayFactory()
    {

        $my = new ArrayFactory();
        $this->assertInternalType('array', $my->types);
        $this->assertInternalType('array', $my->getTypes());


        $factory = new ArrayFactory();
        $this->assertInstanceOf('\dregan\application\UnVerticalArray', $factory->getArray('UnVerticalArray', 5));
        $this->assertInstanceOf('\dregan\application\VerticalArray', $factory->getArray('VerticalArray', 5));
        $this->assertInstanceOf('\dregan\application\HorizontalArray', $factory->getArray('HorizontalArray', 5));






    }
}
