<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MenuTest extends TestCase
{

    public function setUp()
    {
        parent::setUp();
        $this->visit('/');
    }

    public function testOpenPredictionsPage()
    {
        $this->click('Predictions')
             ->seePageIs('predictions')
             ->see('Real time prediction');
    }

    public function testopenMLPage()
    {
        $this->click('ML')
             ->seePageIs('ml')
             ->see('ML Models');
    }

    public function testopenListS3Page()
    {
        $this->click('List S3')
             ->seePageIs('s3/list')
             ->see('List of files');
    }

    public function testopenCeneratorPage()
    {
        $this->click('Generator')
             ->seePageIs('generator')
             ->see('Generate dataset');
    }

    public function testopenBucketPage()
    {
        $this->click('Buckets');
    }

}
