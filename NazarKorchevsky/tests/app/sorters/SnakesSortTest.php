<?php

namespace sa\tests\app\sorters;

use PHPUnit_Framework_TestCase;
use sa\app\sorters\SnakesSort;
use sa\app\NewArray;

class SnakesSortTest extends PHPUnit_Framework_TestCase
{

    public $arrayTestASC = array(
            array(1, 2, 3),
            array(6, 5, 4),
            array(7, 8, 9)
        );

     public $arrayTestDESC = array(
            array(7, 8, 9),
            array(6, 5, 4),
            array(1, 2, 3)
        );


    public function testSnakesSort()
    {

        NewArray::$array = array(
        array(1, 2, 3),
        array(4, 5, 6),
        array(7, 8, 9)
    );


        $test = new SnakesSort;

        $test->setOrder('ASC');
        $this->assertEquals($this->arrayTestASC, $test->sort());

        $this->assertInternalType('array', NewArray::$array);


    }

    public function testSnakesSortDESC()
    {

        NewArray::$array = array(
        array(9, 8, 7),
        array(6, 5, 4),
        array(3, 2, 1)
    );


        $test = new SnakesSort;

        $test->setOrder('DESC');
        $this->assertEquals($this->arrayTestDESC, $test->sort());

        $this->assertInternalType('array', NewArray::$array);


    }

    public function testAddToFactory()
    {

        $test = new SnakesSort;
        $this->assertTrue($test->addToFactoryArray());
    }

}