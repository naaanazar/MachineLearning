<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laracasts\Integrated\Extensions\Selenium;

class MenuTest extends Selenium
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

    public function testOpenMLPage()
    {
        $this->click('ML')
            ->seePageIs('ml')
            ->see('ML Models');
    }

    public function testOpenListS3Page()
    {
        $this->click('List S3')
            ->seePageIs('s3/list')
            ->see('List of files');
    }

    public function testOpenCeneratorPage()
    {
        $this->click('Generator')
            ->seePageIs('generator')
            ->see('Generate dataset');
    }
    
    public function testCreateBucket()
    {
        $this->click('Buckets')
            ->seePageIs('/bucket')
            ->clickCss("#delete-1");
    }
    
    protected function findByCssSelector($selector)
    {
        try {
            return $this->session->element('css selector', $selector);
        } catch (NoSuchElement $e) {
            throw new InvalidArgumentException(
                "Couldn't find an element, matching the follwing css selector: '{$seletor}'."
            );
        }
    }

    public function clickCss($selector)
    {
        $this->findByCssSelector($selector)->click();

        return $this;
    }
}
