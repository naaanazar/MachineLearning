<?php

namespace sa\tests\app\sorters;

use PHPUnit_Framework_TestCase;
use sa\app\sorters\HorizontalSort;
use sa\app\NewArray;

class HorizontalSortTest extends PHPUnit_Framework_TestCase
{

    public $arrayTestASC = array(
            array(1, 2, 3),
            array(4, 5, 6),
            array(7, 8, 9)
    );

    public $arrayTestDESC = array(
            array(9, 8, 7),
            array(6, 5, 4),
            array(3, 2, 1)
    );


    public function testHorizontalSort()
    {

        NewArray::$array = array(
        array(1, 2, 3),
        array(4, 5, 6),
        array(7, 8, 9)
    );


        $test = new HorizontalSort;
        $test->setOrder('ASC');
        $this->assertEquals($this->arrayTestASC, $test->sort());

    }

    public function testHorizontalSortDESC()
    {

        NewArray::$array = array(
        array(1, 2, 3),
        array(4, 5, 6),
        array(7, 8, 9)
    );


        $test = new HorizontalSort;
        $test->setOrder('DESC');
        $this->assertEquals($this->arrayTestDESC, $test->sort());

    }

    public function testAddToFactory()
    {

        $test = new HorizontalSort;
        $this->assertTrue($test->addToFactoryArray());
    }



}