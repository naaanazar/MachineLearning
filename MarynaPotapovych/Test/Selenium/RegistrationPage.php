<?php

namespace liw\Test\Selenium;

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use liw\Test\Selenium\ExpectedCondition;

class RegistrationPage
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
    
    public function registration($mail, $login, $password, $confirmPassword)
    {
        $mailInput = $this->driver->findElement(WebDriverBy::id('join_email'));
        $mailInput->sendKeys($mail);

        $loginInput = $this->driver->findElement(WebDriverBy::id('join_login'));
        $loginInput->sendKeys($login);

        $passwordInput = $this->driver->findElement(WebDriverBy::id('join_password'));
        $passwordInput->sendKeys($password);
        
        $passwordConfInput = $this->driver->findElement(WebDriverBy::id('join_password_confirmation'));
        $passwordConfInput->sendKeys($confirmPassword);

        $focusedElement = $this->driver->findElement(WebDriverBy::xpath("//*[@id='join_form']/fieldset/button"));
        $focusedElement->click();
    }
    
    public function open()
    {
        $this->driver->get('https://crowdin.com/join');
        //$this->driver->wait()->until(ExpectedCondition::pageIsReady());
    }
    
    public function errorMail()
    {
        $selectFile1 = $this->driver->findElement(WebDriverBy::xpath("//*[@id='join_email_message']"));
        $a = $selectFile1->getText();
        return $a;
    }
    public function errorName()
    {
        $selectFile2 = $this->driver->findElement(WebDriverBy::xpath("//*[@id='join_login_message']"));
        $b = $selectFile2->getText();
        return $b;
    }
    
     public function errorPass()
    {
        $selectFile3 = $this->driver->findElement(WebDriverBy::xpath("//*[@id='join_password_message']"));
        $c = $selectFile3->getText();
        return $c;
    }
     public function errorPassConfirm()
    {
        $selectFile4 = $this->driver->findElement(WebDriverBy::xpath("//*[@id='join_password_confirmation_message']"));
        $d = $selectFile4->getText();
        return $d;
    }
}
