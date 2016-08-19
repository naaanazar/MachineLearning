<?php

namespace sa\test\app;

use PHPUnit_Framework_TestCase;
use sa\app\NewArray;

class NewArrayTest extends PHPUnit_Framework_TestCase
{

    protected $array = array(
        array(1, 2, 3, 4, 5),
        array(6, 7, 8, 9, 10),
        array(11, 12, 13, 14, 15),
        array(16, 17, 18, 19, 20),
        array(21, 22, 23, 24, 25)
    );

 

    /**
    * @dataProvider provider
    */

    public function testNewArrayCount($a, $b, $c)
    {
        $testcount = new NewArray;       
        $this->assertEquals($a, count($testcount->crArray($a, $b, $c)));
        $this->assertEquals($a, count($testcount->crArray($a, $b, $c)));
        $this->assertEquals($b, max(array_map('count', $this->array)));
    }    

    public function provider()
    {
        return array(
         array(5, 5, 'successively'),
         array(5, 5, 'random')
        );
    }
    
    public function testNew()
    {
        
        $array = array(
        array(1, 2, 3, 4, 5),
        array(6, 7, 8, 9, 10),
        array(11, 12, 13, 14, 15),
        array(16, 17, 18, 19, 20),
        array(21, 22, 23, 24, 25)
        );
        
        $testcount = new NewArray;       
        $this->assertEquals($this->array, $array);
        
    }  



}