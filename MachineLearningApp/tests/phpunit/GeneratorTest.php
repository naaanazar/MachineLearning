<?php

namespace MachineLearning;

use PHPUnit_Framework_TestCase;
use App\Http\Controllers\GeneratorController;

class GeneratorTest extends PHPUnit_Framework_TestCase
{
    protected $fixture;
    public function setUp()
    {
        parent::setUp();
        $this->fixture = new GeneratorController();
        
        
    }

    protected function tearDown()
    {
        $this->fixture = NULL;
    }

    public function testEqual()
    {
        $generatorRequest = new \App\Http\Requests\GeneratorRequest();
        $generatorRequest->rows = 500;
        $dataset = $this->fixture->generateDataset($generatorRequest);
        $dataset = json_decode($dataset);
        
        
        $expectedArray = array(
            'recordsNumber',
            'purchaseNumber',
            'purchasePercentage',
            'path'
        );
        $this->assertArrayHasKey('recordsNumber', $dataset);
        $this->assertArrayHasKey('purchaseNumber', $dataset);
        $this->assertArrayHasKey('purchasePercentage', $dataset);
        $this->assertArrayHasKey('path', $dataset);
    }
}
