<?php
namespace arrays\test;

use arrays\app\arr\out\OutPut;
use PHPUnit_Framework_TestCase;

class OutPutTest extends \PHPUnit_Framework_TestCase
{
    /**
    * @dataProvider providerOutput
    */

    public function testOutPuts($number, $expstr)
    {
        $this->expectOutputString($expstr);

        print OutPut::OutPuts($number);
    }

    public function providerOutput ()
    {
        return array (
            array (3, '3&nbsp;&nbsp;&nbsp;'),
            array (10, '10&nbsp;'),
            array (1, '1&nbsp;&nbsp;&nbsp;'),
            array (43, '43&nbsp;')
        );
    }
}
