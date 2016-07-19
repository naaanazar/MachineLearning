<?php

namespace sa\tests\app\sorters;

use PHPUnit_Framework_TestCase;
use sa\app\sorters\SpiralSort;
use sa\app\NewArray;

class SpiralSortTest extends PHPUnit_Framework_TestCase
{

    public $arrayTest = array(
            array(1, 2, 3),
            array(8, 9, 4),
            array(7, 6, 5)
        );


    public function testSpiralSort()
    {

        NewArray::$array = array(
            array(1, 2, 3),
            array(4, 5, 6),
            array(7, 8, 9)
        );

        $test = new SpiralSort;

        $test->setOrder('ASC');
        $this->assertEquals($this->arrayTest, $test->sort());

    }

    public function testAddToFactory()
    {

        $test = new SpiralSort;
        $this->assertTrue($test->addToFactoryArray());
    }

}