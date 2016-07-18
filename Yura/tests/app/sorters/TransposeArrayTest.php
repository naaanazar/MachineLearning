<?php

namespace yu\app\tests\sorters;

use yu\app\sorters\TransposeArray;
use PHPUnit_Framework_TestCase;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Transpo
 *
 * @author yurii
 */
class TransposeArrayTest extends PHPUnit_Framework_TestCase{
     public function testTransposeArray(){

        $expected ="<br>1&nbsp;&nbsp;&nbsp;6&nbsp;&nbsp;&nbsp;11&nbsp;16&nbsp;21&nbsp;</br>2&nbsp;&nbsp;&nbsp;7&nbsp;&nbsp;&nbsp;12&nbsp;17&nbsp;22&nbsp;</br>3&nbsp;&nbsp;&nbsp;8&nbsp;&nbsp;&nbsp;13&nbsp;18&nbsp;23&nbsp;</br>4&nbsp;&nbsp;&nbsp;9&nbsp;&nbsp;&nbsp;14&nbsp;19&nbsp;24&nbsp;</br>5&nbsp;&nbsp;&nbsp;10&nbsp;15&nbsp;20&nbsp;25&nbsp;</br>";
         $TransposeArray = new TransposeArray();
          $this->assertEquals($expected, $TransposeArray->sort());

     }
}

