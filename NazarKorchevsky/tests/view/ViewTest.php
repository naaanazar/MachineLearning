<?php

namespace sa\tests\view;

use PHPUnit_Framework_TestCase;
use sa\app\view\View;

class ViewTest extends PHPUnit_Framework_TestCase
{

    public function testView()
    {

        $test = new View;
        $this->assertNotEmpty($test->getHtml());
    }

   
}

