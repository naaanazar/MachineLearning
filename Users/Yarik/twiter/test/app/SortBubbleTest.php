<?php

namespace Projarr\Test\App;

use PHPUnit_Framework_TestCase;
use Projarr\App\SortBubble;

class SortBubbleTest extends PHPUnit_Framework_TestCase {

//    public $array = array();
//    private $arrayHeight = 0;
//    private $arrayLength = 0;

//    public function testSetArrayDimensions($arrayHeight, $arrayLength)
//    {
//        $my = new SortBubble();
//        $this->assertEquals(4, $my->arrayHeight(4));
//        $this->assertEquals(4, $my->arrayLength(4));
//        $this->arrayHeight = $arrayHeight;
//        $this->arrayLength = $arrayLength;
//    }
//
//    public function testSetArray($array)
//    {
//        $this->array = $array;
//    }

    public function testSortArr()
    {
        $my = new SortBubble();
        $this->assertEquals(16, count($my->sortArr()));
    }
}
