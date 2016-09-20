<?php

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

class MenuTest extends \PHPUnit_Framework_TestCase
{
    protected $driver;

    public function addDataProvider()
    {
        return array (
            array ('http://192.168.2.134:9515', DesiredCapabilities::chrome()),
            array ('http://192.168.2.134:4444/wd/hub', DesiredCapabilities::firefox())
        );
    }

    public function tearDown()
    {
        $this->driver->quit();
    }

    /**
     * @dataProvider addDataProvider
     */
    public function testOpenPredictionsPage ($host, $desiredCapabilities)
    {
        $this->driver = RemoteWebDriver::create($host, $desiredCapabilities);
        $this->driver->get('http://laravel:3080/s3');

        $predictions = $this->driver->findElement(WebDriverBy::xpath("//a[.='Predictions']"));
        $predictions->click();

        $this->driver->wait()->until(WebDriverExpectedCondition::titleIs("Crowdin Space Machine Learning App"));
        $this->assertEquals('http://laravel:3080/predictions', $this->driver->getCurrentURL()); // getCurrentURL() - повертає url поточної сторінки
    }

    /**
     * @dataProvider addDataProvider
     */
    public function testOpenMLPage ($host, $desiredCapabilities)
    {
        $this->driver = RemoteWebDriver::create($host, $desiredCapabilities);
        $this->driver->get('http://laravel:3080');

        $ml = $this->driver->findElement(WebDriverBy::xpath("//a[.='ML']"));
        $ml->click();

        $this->driver->wait()->until(WebDriverExpectedCondition::titleIs("Crowdin Space Machine Learning App"));
        $this->assertEquals('http://laravel:3080/ml', $this->driver->getCurrentURL()); // getCurrentURL() - повертає url поточної сторінки
    }

    /**
     * @dataProvider addDataProvider
     */
    public function testOpenListS3Page ($host, $desiredCapabilities)
    {
        $this->driver = RemoteWebDriver::create($host, $desiredCapabilities);
        $this->driver->get('http://laravel:3080');

        $listS3 = $this->driver->findElement(WebDriverBy::xpath("//a[.='List S3']"));
        $listS3->click();

        $this->driver->wait()->until(WebDriverExpectedCondition::titleIs("Crowdin Space Machine Learning App"));
        $this->assertEquals('http://laravel:3080/s3/list', $this->driver->getCurrentURL()); // getCurrentURL() - повертає url поточної сторінки
    }

    /**
     * @dataProvider addDataProvider
     */
    public function testOpenGeneratorPage ($host, $desiredCapabilities)
    {
        $this->driver = RemoteWebDriver::create($host, $desiredCapabilities);
        $this->driver->get('http://laravel:3080');

        $generator = $this->driver->findElement(WebDriverBy::xpath("//a[.='Generator']"));
        $generator->click();

        $this->driver->wait()->until(WebDriverExpectedCondition::titleIs("Crowdin Space Machine Learning App"));
        $this->assertEquals('http://laravel:3080/generator', $this->driver->getCurrentURL()); // getCurrentURL() - повертає url поточної сторінки
    }

    /**
     * @dataProvider addDataProvider
     */
    public function testOpenBucketsPage ($host, $desiredCapabilities)
    {
        $this->driver = RemoteWebDriver::create($host, $desiredCapabilities);
        $this->driver->get('http://laravel:3080');

        $buckets = $this->driver->findElement(WebDriverBy::xpath("//a[.='Buckets']"));
        $buckets->click();

        $this->driver->wait()->until(WebDriverExpectedCondition::titleIs("Crowdin Space Machine Learning App"));
        $this->assertEquals('http://laravel:3080/s3', $this->driver->getCurrentURL()); // getCurrentURL() - повертає url поточної сторінки
    }
}