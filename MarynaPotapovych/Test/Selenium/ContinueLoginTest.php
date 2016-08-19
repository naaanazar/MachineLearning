<?php

namespace liw\Test\Selenium;
use liw\Test\Selenium\LoginPage;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use liw\Test\Selenium\ExpectedCondition;
use Facebook\WebDriver\WebDriverKeys;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\Remote\LocalFileDetector;

class ContinueLoginTest extends \PHPUnit_Framework_TestCase
{
    
    public function testContinue()
    {
        $host = 'http://192.168.2.134:9515';
        $driver = RemoteWebDriver::create($host, DesiredCapabilities::chrome());
        $loginPage = new LoginPage($driver);
        $loginPage->open();
        $loginPage->login('NataliaRich', 'qwerty03');
       // $this->assertEquals("Looks like that's not right. Give it another try?", $loginPage->error());
        
        
    }
}
