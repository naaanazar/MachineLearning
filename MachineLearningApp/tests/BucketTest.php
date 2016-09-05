<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Laracasts\Integrated\Extensions\Selenium as IntegrationTest;

class BucketTest extends IntegrationTest
{
    public function setUp()
    {
        parent::setUp();
        $this->visit('/');
    }
    
    protected function findByCssSelector($selector)
    {
        try {
            return $this->session->element('css selector', $selector);
        } catch (NoSuchElement $e) {
            throw new InvalidArgumentException(
                "Couldn't find an element, matching the following css selector: '{$selector}'."
            );
        }
    }

    public function clickCss($selector)
    {
        $this->findByCssSelector($selector)->click();

        return $this;
    }
    
//    public function testopenBucketPage()
//    {
//        $this->click('Buckets');
//    }
//    
//    public function testcreateBucket()
//    {
//        $this->click('Buckets')
//             ->seePageIs('bucket')
//             ->type( 'ml-set-testing', 'nameBucket')
//             ->press('Submit');
//    }
    
    public function testdeleteBucket()
    {
        $this->click('Buckets')
             ->seePageIs('bucket')
             ->clickCss("a[href='/bucket/delete/ml-test-back']");
    }
}
