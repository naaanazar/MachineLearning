<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ListS3Test extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->visit('/');
    }

    public function testOpenListS3()
    {
        $this->click('List S3');
//             ->seePageIs('http://laravel:3080/s3/list');
    }
    
}
