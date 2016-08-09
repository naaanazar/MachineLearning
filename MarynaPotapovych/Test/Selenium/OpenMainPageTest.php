<?php

namespace liw\Test\Selenium;

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

class OpenMainPageTest extends \PHPUnit_Framework_TestCase
{

    protected $driver;
    public function dataProvider()
    {
            
       return array (
         array('http://192.168.1.153:9515', DesiredCapabilities::chrome()),
         array('http://192.168.1.153:4444/wd/hub', DesiredCapabilities::firefox()), 
       );
    }

    public function setUp()
    {
                
    }

    public function tearDown()
    {
        $this->driver->quit();
    }
    /**
     * @dataProvider dataProvider
     */
    public function testOpenSuccsess($host, $desiredCapabilities)
    {
        
        $this->driver = RemoteWebDriver::create($host, $desiredCapabilities);
        $this->driver->get('https://crowdin.com');
        $element = $this->driver->findElement(WebDriverBy::linkText('Log in'));
        $element->click();

        $this->assertEquals('https://crowdin.com/login', $this->driver->getCurrentURL());
        $this->assertEquals('Log In - Crowdin', $this->driver->getTitle());

        $loginInput = $this->driver->findElement(WebDriverBy::id('login_login'));
        $loginInput->sendKeys("MarynkaP");

        $passwordInput = $this->driver->findElement(WebDriverBy::id('login_password'));
        $passwordInput->sendKeys("qwerty04");

        $focusedElement = $this->driver->findElement(WebDriverBy::xpath("//*[@id='login_form']/fieldset/button"));
        $focusedElement->click();

        $this->driver->wait()->until(WebDriverExpectedCondition::titleIs("MarynkaP's Profile - Users at Crowdin"));
    }
    /**
     * @dataProvider dataProvider
     */
    public function testOpenWithEmptyPass($host, $desiredCapabilities)
    {
        $this->driver = RemoteWebDriver::create($host, $desiredCapabilities);
        $this->driver->get('https://crowdin.com');
        $element = $this->driver->findElement(WebDriverBy::linkText('Log in'));
        $element->click();

        $this->assertEquals('https://crowdin.com/login', $this->driver->getCurrentURL());
        $this->assertEquals('Log In - Crowdin', $this->driver->getTitle());

        $loginInput = $this->driver->findElement(WebDriverBy::id('login_login'));
        $loginInput->sendKeys("MarynkaP");

        $passwordInput = $this->driver->findElement(WebDriverBy::id('login_password'));
        $passwordInput->sendKeys("");

        $focusedElement = $this->driver->findElement(WebDriverBy::xpath("//*[@id='login_form']/fieldset/button"));
        $focusedElement->click();

        $this->driver->wait()->until(WebdriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath('//*[@id="login_failed_block"]')));
    }
    /**
     * @dataProvider dataProvider
     */
    public function testOpenWithWrongPass($host, $desiredCapabilities)
    {
        $this->driver = RemoteWebDriver::create($host, $desiredCapabilities);
        $this->driver->get('https://crowdin.com');
        $element = $this->driver->findElement(WebDriverBy::linkText('Log in'));
        $element->click();

        $this->assertEquals('https://crowdin.com/login', $this->driver->getCurrentURL());
        $this->assertEquals('Log In - Crowdin', $this->driver->getTitle());

        $loginInput = $this->driver->findElement(WebDriverBy::id('login_login'));
        $loginInput->sendKeys("MarynkaP");

        $passwordInput = $this->driver->findElement(WebDriverBy::id('login_password'));
        $passwordInput->sendKeys("vbnmgh");

        $focusedElement = $this->driver->findElement(WebDriverBy::xpath("//*[@id='login_form']/fieldset/button"));
        $focusedElement->click();

        $this->driver->wait()->until(WebdriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath('//*[@id="login_failed_block"]')));
    }

}
