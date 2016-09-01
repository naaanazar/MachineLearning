<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PredictionsTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->visit('/');
    }

    public function testOpenPredictions()
    {
        $this->visit('predictions')
             ->seePageIs('predictions')
             ->see('Real time prediction');
    }
}
