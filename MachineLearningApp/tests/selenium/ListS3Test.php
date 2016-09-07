<?php

namespace Projarr\Test\Selenium;

use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;

class ListS3Test  extends \PHPUnit_Framework_TestCase {

    protected $driver;

    public function setUp()
    {
////        $this->driver = RemoteWebDriver::create('http://192.168.45.109:9515', DesiredCapabilities::chrome());
//        $this->driver = RemoteWebDriver::create('http://192.168.2.134:9515', DesiredCapabilities::chrome());
////        $this->driver = RemoteWebDriver::create('http://192.168.0.105:9515', DesiredCapabilities::chrome());
//        $this->driver->manage()->window()->maximize(); //відкриває сторінку на повний екран
//        $this->driver->get('http://laravel:3080/');

        $this->setBrowser(httpDesiredCapabilities::firefox());
        $this->setBrowserUrl('http://laravel:3080/');

    }

    public function testOpenListPage()
    {
        $buttonListS3 = $this->driver->findElement(WebDriverBy::xpath("*//nav/div/ul/li[2]/a"));
        $buttonListS3->click();

        $this->driver->wait()->until(WebDriverExpectedCondition::titleIs("*//div/h3/text()"));
        $this->assertEquals('http://laravel:3080/list', $this->driver->getCurrentURL()); // getCurrentURL() - повертає url поточної сторінки
    }
}
