<?php

use app\Factory\SortFactory;
use app\Sorter\DiagonalSort;
use app\Sorter\HorizontalSort;
use app\Sorter\SpiralSort;
use app\Sorter\ZetSort;

class SortFactoryTest extends PHPUnit_Framework_TestCase {

    public function testGetSort() {

        $defaultSort = SortFactory::getSort();

        $factoryHorizontalSort = SortFactory::getSort('horizontal');
        $factoryDiagonalSort = SortFactory::getSort('diagonal');
        $factorySpiralSort = SortFactory::getSort('spiral');
        $factoryZetSort = SortFactory::getSort('zet');

        $horizontalSort = new HorizontalSort;
        $diagonalSort = new DiagonalSort;
        $spiralSort = new SpiralSort;
        $zetSort = new ZetSort;


        $this->assertEquals($factoryHorizontalSort, $horizontalSort);
        $this->assertEquals($diagonalSort, $factoryDiagonalSort);
        $this->assertEquals($spiralSort, $factorySpiralSort);
        $this->assertEquals($defaultSort, $horizontalSort);
        $this->assertEquals($zetSort, $factoryZetSort);
        
    }
    

}
