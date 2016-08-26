<?php

namespace Projarr\Test\Selenium;

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverKeys;


class AlertTest extends \PHPUnit_Framework_TestCase {

    protected $driver;

    public function testAlert()
    {
        //$this->driver = RemoteWebDriver::create('http://192.168.1.156:9515', DesiredCapabilities::chrome());
        $this->driver = RemoteWebDriver::create('http://192.168.0.105:9515', DesiredCapabilities::chrome());
        $this->driver->manage()->window()->maximize(); //відкриває сторінку на повний екран
        $this->driver->get('http://www.javascriptkit.com/javatutors/alert2.shtml');

        $selectLeng = $this->driver->findElement(WebDriverBy::xpath("//*[@id='contentcolumn']/form/p/input"));
        $selectLeng->click();
        $this->driver->wait()->until(WebDriverExpectedCondition::alertIsPresent()); //очікує на вікно alert
        //sleep(1);
        $a = $this->driver->switchTo()->alert()->getText();
        $b = 'My name is George. Welcome!';
        $this->assertEquals($a, $b);
        $this->driver->switchTo()->alert()->accept();
    }
}