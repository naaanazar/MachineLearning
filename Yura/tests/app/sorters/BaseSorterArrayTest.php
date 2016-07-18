<?php

use PHPUnit_Framework_TestCase;
use yu\app\sorters\BaseSorterArray;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BaseSorterArrayTest
 *
 * @author yurii
 */
class BaseSorterArrayTest extends PHPUnit_Framework_TestCase{

    public function testBaseSorterArray() {

        $expected = "111";
        $this->assertEquals($expected, BaseSorterArray::class );

    }
}
