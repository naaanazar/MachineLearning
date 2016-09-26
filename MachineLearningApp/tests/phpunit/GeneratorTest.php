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

        // Hack!
        // TODO: Find a better solution
        require_once __DIR__.'/../../bootstrap/app.php';
    }

    protected function tearDown()
    {
        $this->fixture = NULL;
    }

    public function testEqual()
    {
        $generatorRequest = new \App\Http\Requests\GeneratorRequest();
        $generatorRequest->rows = 500;
        $dataset = json_decode($this->fixture->generateDataset($generatorRequest), true);

        $expectedArray = array(
            'recordsNumber',
            'purchaseNumber',
            'purchasePercentage',
            'path'
        );

        $this->assertObjectHasAttribute('recordsNumber', $dataset);
        $this->assertArrayHasKey('purchaseNumber', $dataset);
        $this->assertArrayHasKey('purchasePercentage', $dataset);
        $this->assertArrayHasKey('path', $dataset);
    }
}
