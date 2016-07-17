<?php

namespace ex\Tests;

use ex\app\FactorySort;
use PHPUnit_Framework_TestCase;


class ExceptionTest extends PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider dataType
     * @expectedException Exception
     * @expectedExceptionMessage Type does not exist
     */
    public function testException($type)
    {
        FactorySort::factorySort($type, 4);
    }

    public function dataType()
    {
        return array(
            array('snsake'),
            array('spsiral'),
            array('diagonalf'),
        );
    }

}
