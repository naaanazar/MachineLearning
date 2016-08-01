<?php
namespace project\test\application;

use PHPUnit_Framework_TestCase;
use project\application\ArrayFactory;
use project\application\ArraySorts\StandartSorter;
use project\application\ArraySorts\SnakeSorter;
use project\application\ArraySorts\SpiralSorter;
use project\application\ArraySorts\SpiralRevSorter;
use project\application\ArraySorts\VerticalSorter;
use project\application\ArraySorts\VerticalRevSorter;

class ArrayFactoryTest extends PHPUnit_Framework_TestCase
{
    public function testGetAllType()
    {
        $sorterFactory = new ArrayFactory();
        $this->assertEquals(
                array("standart", "snake", "spiral", "spiral reverse", "vertical", "vertical reverse"),
                $sorterFactory->getAllType());
    }

    /**
    * @dataProvider providerSorter
    */
    public  function testGetSorter($a, $b)
    {
        $sorterFactory = new ArrayFactory();

        $this->assertEquals($a, $sorterFactory->getSorter($b));
    }

    public function providerSorter()
    {
        return array (
            array(new StandartSorter(), "standart"),
            array(new SnakeSorter(), "snake"),
            array(new SpiralSorter(), "spiral"),
            array(new SpiralRevSorter(), "spiral reverse"),
            array(new VerticalSorter(), "vertical"),
            array(new VerticalRevSorter(), "vertical reverse"),
        );
    }

    public function testException()
    {
        $this->setExpectedException('Exception');
        $sorterFactory = new ArrayFactory();
        $sorterFactory->getSorter('fail');
    }
}
