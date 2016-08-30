<?php

namespace yu\app\tests\sorters;

use yu\app\sorters\TransposeArrayInversion;
use PHPUnit_Framework_TestCase;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TransposeArrayInversionTest
 *
 * @author yurii
 */
class TransposeArrayInversionTest extends PHPUnit_Framework_TestCase{

    public function testTransposeArrayInversion(){
        $expected =("<br>25&nbsp;20&nbsp;15&nbsp;10&nbsp;5&nbsp;&nbsp;&nbsp;</br>24&nbsp;19&nbsp;14&nbsp;9&nbsp;&nbsp;&nbsp;4&nbsp;&nbsp;&nbsp;</br>23&nbsp;18&nbsp;13&nbsp;8&nbsp;&nbsp;&nbsp;3&nbsp;&nbsp;&nbsp;</br>22&nbsp;17&nbsp;12&nbsp;7&nbsp;&nbsp;&nbsp;2&nbsp;&nbsp;&nbsp;</br>21&nbsp;16&nbsp;11&nbsp;6&nbsp;&nbsp;&nbsp;1&nbsp;&nbsp;&nbsp;</br>");

       $TransposeArrayInversion = new TransposeArrayInversion;
       $this->assertEquals($expected, $TransposeArrayInversion->sort());

    }
}
