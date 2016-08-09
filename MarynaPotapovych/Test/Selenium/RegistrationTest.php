<?php

namespace liw\Test\Selenium;

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;


class RegistrationTest extends \PHPUnit_Framework_TestCase
{
    protected $driver;

    public function setUp()
    {
        $host = 'http://192.168.1.153:4444/wd/hub';
        $this->driver = RemoteWebDriver::create($host, DesiredCapabilities::firefox());
        $this->driver->get('https://crowdin.com');
    }

    public function tearDown()
    {
        $this->driver->quit();
    }
    
   /* public function testOpenSuccsess()
    {

        $element = $this->driver->findElement(WebDriverBy::linkText('Sign up'));
        $element->click();

        $this->assertEquals('https://crowdin.com/join', $this->driver->getCurrentURL());
        $this->assertEquals('Sign up for Crowdin', $this->driver->getTitle());
        
        $mailInput = $this->driver->findElement(WebDriverBy::id('join_email'));
        $mailInput->sendKeys("nataliarichards123@gmail.com");

        $loginInput = $this->driver->findElement(WebDriverBy::id('join_login'));
        $loginInput->sendKeys("NataliaRich");

        $passwordInput = $this->driver->findElement(WebDriverBy::id('join_password'));
        $passwordInput->sendKeys("qwerty03");
        
        $passwordConfInput = $this->driver->findElement(WebDriverBy::id('join_password_confirmation'));
        $passwordConfInput->sendKeys("qwerty03");

        $focusedElement = $this->driver->findElement(WebDriverBy::xpath("//*[@id='join_form']/fieldset/button"));
        $focusedElement->click();

        //$this->driver->wait()->until(WebDriverExpectedCondition::titleIs("NataliaRich's Profile - Users at Crowdin"));
    }*/
    
    
    
   /* public function testOpenNoSuccsess()
    {

        $element = $this->driver->findElement(WebDriverBy::linkText('Sign up'));
        $element->click();

        $this->assertEquals('https://crowdin.com/join', $this->driver->getCurrentURL());
        $this->assertEquals('Sign up for Crowdin', $this->driver->getTitle());
        
        $mailInput = $this->driver->findElement(WebDriverBy::id('join_email'));
        $mailInput->sendKeys("MarynaPotapovych@gmail.com");

        $loginInput = $this->driver->findElement(WebDriverBy::id('join_login'));
        $loginInput->sendKeys("MarynaP");

        $passwordInput = $this->driver->findElement(WebDriverBy::id('join_password'));
        $passwordInput->sendKeys("qwerty04");
        
        $passwordConfInput = $this->driver->findElement(WebDriverBy::id('join_password_confirmation'));
        $passwordConfInput->sendKeys("qwerty04");

        $focusedElement = $this->driver->findElement(WebDriverBy::xpath("//*[@id='join_form']/fieldset/button"));
        $focusedElement->click();

        $this->driver->wait()->until(WebdriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath('//*[@id="jGrowl"]')));
    }*/
    public function testOpenWithEmpty()
    {

        $element = $this->driver->findElement(WebDriverBy::linkText('Sign up'));
        $element->click();

        $this->assertEquals('https://crowdin.com/join', $this->driver->getCurrentURL());
        $this->assertEquals('Sign up for Crowdin', $this->driver->getTitle());
        
        $mailInput = $this->driver->findElement(WebDriverBy::id('join_email'));
        $mailInput->sendKeys("danaflanders10924@gmail.com");

        $loginInput = $this->driver->findElement(WebDriverBy::id('join_login'));
        $loginInput->sendKeys("DanaFlanders");

        $passwordInput = $this->driver->findElement(WebDriverBy::id('join_password'));
        $passwordInput->sendKeys("");
        
        $passwordConfInput = $this->driver->findElement(WebDriverBy::id('join_password_confirmation'));
        $passwordConfInput->sendKeys("qwerty02");

        $focusedElement = $this->driver->findElement(WebDriverBy::xpath("//*[@id='join_form']/fieldset/button"));
        $focusedElement->click();

        $this->driver->wait()->until(WebdriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath('//*[@id="join_password_message"]')));
    }
    
}
