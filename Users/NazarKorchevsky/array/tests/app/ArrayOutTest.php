<?php

namespace sa\app;

use PHPUnit_Framework_TestCase;
use sa\app\ArrayOut;

class ArrayOutTest extends PHPUnit_Framework_TestCase
{

  

    public function testArrayOut()
    {

        $array = array(
        array(1, 2, 3),
        array(4, 5, 6),
        array(7, 8, 9)
    );
       
        $test = new ArrayOut;

        ob_start();
         $this->assertNotEmpty($test->arrayOut($array));
         ob_end_clean();
    }

   
}

