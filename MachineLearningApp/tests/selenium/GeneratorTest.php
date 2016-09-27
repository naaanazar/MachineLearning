<?php

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;


class GeneratorTest extends \PHPUnit_Framework_TestCase
{
    protected $driver;

    public function addDataProvider()
    {
        return array (
//            array ('http://192.168.2.134:9515', DesiredCapabilities::chrome()),
//            array ('http://192.168.2.134:4444/wd/hub', DesiredCapabilities::firefox())
            array ('http://192.168.0.101:4444/wd/hub', DesiredCapabilities::firefox())
        );
    }

    public function tearDown()
    {
//        $this->driver->quit();
    }

    /**
     * @dataProvider addDataProvider
     */
    public function testGeneratorPage ($host, $desiredCapabilities)
    {
        $this->driver = RemoteWebDriver::create($host, $desiredCapabilities);
        $this->driver->get('http://laravel:3080/generator');

        $this->driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id('rows-number')));

        $rowsNumber = $this->driver->findElement(WebDriverBy::id('rows-number'));
        $rowsNumber->sendKeys(2000);

        $generate = $this->driver->findElement(WebDriverBy::id('generate-btn'));
        $generate->click();
//------------------------------------------------------------------------------ ???
//        sleep(3);
        $this->driver->wait()->until(WebDriverExpectedCondition::textToBePresentInElement($this->driver->findElement(WebDriverBy::xpath('//li[.="Records number: 2000"]')), "Records number: 2000"));
        $RecordsNumber = $this->driver->findElement(WebDriverBy::xpath('//li[.="Records number: 2000"]'))->getText();

//        $this->driver->wait()->until(WebDriverExpectedCondition::titleIs("Crowdin Space Machine Learning App"));
        $this->assertEquals($RecordsNumber, "Records number: 2000");
    }
}
