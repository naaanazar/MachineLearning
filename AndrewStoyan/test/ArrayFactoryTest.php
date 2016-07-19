<?php

namespace arrays\test;

use arrays\app\ArrayFactory;
use PHPUnit_Framework_TestCase;

/**
 *
 * @author dron
 */
class ArrayFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerTypes
     * @expectedException    Exception
     */
    public function testGetArray($type)
    {
        $test = new ArrayFactory();
        $test->number = 3;
        $test->GetArray($type);
        
    }

    
    public function testGetTypes()
    {
        $test = new ArrayFactory($array);
        $test->number = 3;
        $arrTypes = $test->GetTypes($test->number);
        $array = array(
                    "arrays\app\arr\Standart",
                    "arrays\app\arr\Vertical",
                    "arrays\app\arr\RevVertical",
                    "arrays\app\arr\Snake",
                    "arrays\app\arr\Spiral",
                    "arrays\app\arr\RevSpiral",
                    "arrays\app\arr\Diagonal"
                );
        $this->assertEquals($array, $arrTypes);

    }

    public function providerTypes()
    {
        return array (
            array(
                "arrays\app\arr\Standart",
                "arrays\app\arr\Vertical",
                "arrays\app\arr\NonVertical",
                "arrays\app\arr\Spiral",
                
            )
        );
    }
}
