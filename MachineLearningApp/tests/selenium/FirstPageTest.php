<?php

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

class FirstPageTest extends \PHPUnit_Framework_TestCase
{
    protected $driver;

    public function addDataProvider()
    {
        return array (
//            array ('http://192.168.2.134:9515', DesiredCapabilities::chrome()),
            array ('http://192.168.2.134:4444/wd/hub', DesiredCapabilities::firefox())
//            array ('http://192.168.0.101:4444/wd/hub', DesiredCapabilities::firefox())
        );
    }

    public function tearDown()
    {
        $this->driver->quit();
    }

    /**
     * @dataProvider addDataProvider
     */
    public function testOpenFirstPage ($host, $desiredCapabilities)
    {
        $this->driver = RemoteWebDriver::create($host, $desiredCapabilities);
        $this->driver->get('http://laravel:3080');

        sleep(1);

//        $this->driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath("//a[.='About']")));

        $about = $this->driver->findElement(WebDriverBy::xpath("//a[.='About']"));
        $about->click();
 
        $this->driver->findElement(WebDriverBy::xpath("//*[.='Introducing Machine Learning']"))->isDisplayed();

        $benefits = $this->driver->findElement(WebDriverBy::id('button-benefits'));
        $benefits->click();

        $this->driver->findElement(WebDriverBy::xpath('//*[@id="benefitsToShow"]/div[2]/img'))->isDisplayed();

        $backToTop = $this->driver->findElement(WebDriverBy::id("back-to-top"));
        $backToTop->isDisplayed();
        $backToTop->click();

        $tryIt = $this->driver->findElement(WebDriverBy::xpath("//a[.='Try It']"));
        $tryIt->click();

        $this->driver->wait()->until(WebDriverExpectedCondition::titleIs("Crowdin Space Machine Learning App"));
        $this->assertEquals('http://laravel:3080/prediction', $this->driver->getCurrentURL());
    }
}