<?php

namespace Projarr\Test\Selenium;

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverKeys;
use Facebook\WebDriver\Remote\LocalFileDetector;

class SwitchWindowTest extends \PHPUnit_Framework_TestCase {

    protected $driver;

    public function testSwitchWindow()
    {

        $current_handle = $this->driver->getWindowHandle();
        //...
        $driver->switchTo()->window(end($driver->getWindowHandles()));
        //...
        $driver->switchTo()->window($current_handle);
    }
}
