<?php

namespace sa\tests\app\sorters;

use PHPUnit_Framework_TestCase;
use sa\app\sorters\VerticalSort;
use sa\app\NewArray;

class VerticalSortTest extends PHPUnit_Framework_TestCase
{

    public $arrayTestASC = array(
            array(1, 4, 7),
            array(2, 5, 8),
            array(3, 6, 9)          
    );

    public $arrayTestDESC = array(
            array(9, 6, 3),
            array(8, 5, 2),
            array(7, 4, 1)
    );


    public function testVerticalSort()
    {

        NewArray::$array = array(
        array(1, 2, 3),
        array(4, 5, 6),
        array(7, 8, 9)
    );
            
                
        $test = new VerticalSort;
        $test->setOrder('ASC');                
        $this->assertEquals($this->arrayTestASC, $test->sort());

    }

    public function testVerticalSortDESC()
    {

        NewArray::$array = array(
        array(1, 2, 3),
        array(4, 5, 6),
        array(7, 8, 9)
    );


        $test = new VerticalSort;
        $test->setOrder('DESC');
        $this->assertEquals($this->arrayTestDESC, $test->sort());

    }

    public function testAddToFactory()
    {

        $test = new VerticalSort;
        $this->assertTrue($test->addToFactoryArray());
    }



}