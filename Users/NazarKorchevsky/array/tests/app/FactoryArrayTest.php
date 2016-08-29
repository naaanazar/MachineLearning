<?php

namespace sa\tests\app;

use PHPUnit_Framework_TestCase;
use sa\app\FactoryArray;

class FactoryArrayTest extends PHPUnit_Framework_TestCase
{

    /**
    * @dataProvider providerClassName
    */

    public function testgetClass($className)
    {

       $sorter = FactoryArray::getClass($className);

       $this->assertFileExists('app/sorters/' . $className. '.php');

    }

    public function providerClassName()
    {
        return array(
         array('VerticalSort'),
         array('SpiralSort'),
         array('HorizontalSort'),
         array('SnakesSort')
        );
    }
}

