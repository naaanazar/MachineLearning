<?php

namespace liw\Test\Selenium;

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use liw\Test\Selenium\ExpectedCondition;

class LoginPage 
{
    /**
     *
     * @var RemoteWebDriver
     */
    protected $driver;
    public function __construct($driver)
    { 
        $this->driver = $driver;
    }
    
    public function login($login, $password)
    {
        $loginInput = $this->driver->findElement(WebDriverBy::id('login_login'));
        $loginInput->sendKeys($login);

        $passwordInput = $this->driver->findElement(WebDriverBy::id('login_password'));
        $passwordInput->sendKeys($password);

        $focusedElement = $this->driver->findElement(WebDriverBy::xpath("//*[@id='login_form']/fieldset/button"));
        $focusedElement->click();
    }
    
    public function open()
    {
        $this->driver->get('https://crowdin.com/login');
        //$this->driver->wait()->until(ExpectedCondition::pageIsReady());
    }
    
    public function error()
    {
        $selectFile1 = $this->driver->findElement(WebDriverBy::xpath("//*[@id='login_failed_block']"));
        $b = $selectFile1->getText();
        return $b;
    }
}
