<?php

namespace MachineLearning;

use PHPUnit_Framework_TestCase;
use App\Http\Controllers\MLController;

class MLTest extends PHPUnit_Framework_TestCase
{
   protected $fixture;
    
    protected function setUp()
    {
        require_once __DIR__.'/../../bootstrap/app.php';
        parent::setUp();
        $this->fixture = new MLController(); 
        
    }

    protected function tearDown()
    {
        $this->fixture = NULL;
    }
    
    public function testListDataSources()
    {
        $a = $this->fixture->listDataSources();
        $this->assertEmpty($a);
    }
}
