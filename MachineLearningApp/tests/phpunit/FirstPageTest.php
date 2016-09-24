<?php

namespace MachineLearning;

use PHPUnit_Framework_TestCase;
use App\Http\Controllers\FirstPageController;

class FirstPageTest extends PHPUnit_Framework_TestCase
{
    protected $fixture;
    
    protected function setUp()
    {
        parent::setUp();
        $this->fixture = new FirstPageController(); 
        require_once __DIR__.'/../../bootstrap/app.php';
    }

    protected function tearDown()
    {
        $this->fixture = NULL;
    }
    
    public function testFirstPage()
    {
        $a = $this->fixture->firstPage();
        $this->assertEmpty($a);
    }
    
    
}
