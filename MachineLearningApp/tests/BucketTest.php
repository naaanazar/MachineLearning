<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;


class BucketTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->visit('/');
    }
    
    public function testopenBucketPage()
    {
        $this->click('Buckets');
    }
    
    public function testcreateBucket()
    {
        $this->click('Buckets')
             ->seePageIs('bucket')
             ->type( 'ml-set-testing', 'nameBucket')
             ->press('Submit');
    }
    
     public function testdeleteBucket()
    {
        $this->click('Buckets')
             ->seePageIs('bucket')
             ->clickCss("a[href='/bucket/delete/ml-test-back']");
    }
}
