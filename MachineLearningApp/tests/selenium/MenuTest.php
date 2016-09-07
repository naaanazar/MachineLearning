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
        $this->driver->get('http://laravel:3080/bucket');

        $Predictions = $this->driver->findElement(WebDriverBy::xpath("//nav/div/ul/li[1]/a"));
        $Predictions->click();

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

        $Predictions = $this->driver->findElement(WebDriverBy::xpath("//nav/div/ul/li[2]/a"));
        $Predictions->click();

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

        $Predictions = $this->driver->findElement(WebDriverBy::xpath("//nav/div/ul/li[3]/a"));
        $Predictions->click();

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

        $Predictions = $this->driver->findElement(WebDriverBy::xpath("//nav/div/ul/li[4]/a"));
        $Predictions->click();

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

        $Predictions = $this->driver->findElement(WebDriverBy::xpath("//nav/div/ul/li[5]/a"));
        $Predictions->click();

        $this->driver->wait()->until(WebDriverExpectedCondition::titleIs("Crowdin Space Machine Learning App"));
        $this->assertEquals('http://laravel:3080/bucket', $this->driver->getCurrentURL()); // getCurrentURL() - повертає url поточної сторінки
    }
}