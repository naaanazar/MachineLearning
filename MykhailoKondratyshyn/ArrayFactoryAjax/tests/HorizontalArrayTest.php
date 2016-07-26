<?php
/**
 * Created by PhpStorm.
 * User: dregan
 * Date: 18.07.16
 * Time: 21:45
 */

namespace dregan\tests;

use dregan\application\HorizontalArray;
use dregan\application\VerticalArray;
use PHPUnit_Framework_TestCase;
class HorizontalArrayTest extends PHPUnit_Framework_TestCase
{
    public function testHorizontalArray()
    {

        $my = new HorizontalArray(5);
        $this->assertInternalType('array', $my->sortArray());

    }



}
