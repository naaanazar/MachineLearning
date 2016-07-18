<?php
namespace yu\tests\app\sorters;

use yu\app\sorters\ArrayHorizontal;
use PHPUnit_Framework_TestCase;

class ArrayHorizontalTest extends PHPUnit_Framework_TestCase {

    public function testArrayHorizontal() {
        
        $baseArray = new ArrayHorizontal();
      echo $baseArray->sort();
    $expected = "1&nbsp;&nbsp;2&nbsp;&nbsp;3&nbsp;&nbsp;4&nbsp;&nbsp;5&nbsp;&nbsp;</br>6&nbsp;&nbsp;7&nbsp;&nbsp;8&nbsp;&nbsp;9&nbsp;&nbsp;10&nbsp;</br>11&nbsp;12&nbsp;13&nbsp;14&nbsp;15&nbsp;</br>16&nbsp;17&nbsp;18&nbsp;19&nbsp;20&nbsp;</br>21&nbsp;22&nbsp;23&nbsp;24&nbsp;25&nbsp;</br>";
        $assertEquals = $this->assertEquals($expected, $baseArray->sort());
    }
}