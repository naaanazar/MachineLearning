<?php

use PHPUnit_Framework_TestCase;
use yu\app\ArraySorterFactory;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ArraySortedFactoryTest
 *
 * @author yurii
 */
class ArraySortedFactoryTest extends PHPUnit_Framework_TestCase{
    public function testGetSorter(){
        $Sorter = new ArraySorterFactory();
        $Sorter->getAllTypes();
        $expected = ArraySorterFactory::getAllTypes();

        $this->assertEquals($expected, $Sorter);

    }
}