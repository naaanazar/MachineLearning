<?php

namespace liw\Test\Selenium;
use liw\Test\Selenium\RegistrationPage;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;

class ContinueRegistrationTest extends \PHPUnit_Framework_TestCase
{
    public function testContinue()
    {
        $host = 'http://192.168.1.153:9515';
        $driver = RemoteWebDriver::create($host, DesiredCapabilities::chrome());
        $registratonPage = new RegistrationPage($driver);
        $registratonPage->open();
        $registratonPage->registration('danaflanders10924@gmail.com', 'DanaFlanders', 'qwerty0','qwerty02');
        //$this->assertEquals("Invalid email.", $registratonPage->errorMail());
        //$this->assertEquals("User name must be at least 3 characters.", $registratonPage->errorName());
        //$this->assertEquals("Password is too short (minimum is 6 characters", $registratonPage->errorPass());
        //$this->assertEquals("The passwords don't match, please try again.", $registratonPage->errorPassConfirm());

    }
    
    public function testContinueEmail()
    {
        $host = 'http://192.168.1.153:9515';
        $driver = RemoteWebDriver::create($host, DesiredCapabilities::chrome());
        $registratonPage = new RegistrationPage($driver);
        $registratonPage->open();
        $registratonPage->registration('danaflanders10924', 'DanaFlanders', 'qwerty02','qwerty02');
        $this->assertEquals("Invalid email.", $registratonPage->errorMail());
        
    }
    
    public function testContinueName()
    {
        $host = 'http://192.168.1.153:9515';
        $driver = RemoteWebDriver::create($host, DesiredCapabilities::chrome());
        $registratonPage = new RegistrationPage($driver);
        $registratonPage->open();
        $registratonPage->registration('danaflanders10924@gmail.com', 'DanaFlanders', 'qwerty0','qwerty02');
        $this->assertEquals("User name must be at least 3 characters.", $registratonPage->errorName());
        
    }
    
    public function testContinuePass()
    {
        $host = 'http://192.168.1.153:9515';
        $driver = RemoteWebDriver::create($host, DesiredCapabilities::chrome());
        $registratonPage = new RegistrationPage($driver);
        $registratonPage->open();
        $registratonPage->registration('danaflanders10924@gmail.com', 'DanaFlanders', 'qwerty0','qwerty02');
        $this->assertEquals("Password is too short (minimum is 6 characters)", $registratonPage->errorPass());
    
    }
    
     public function testContinueConfirmPass()
    {
        $host = 'http://192.168.1.153:9515';
        $driver = RemoteWebDriver::create($host, DesiredCapabilities::chrome());
        $registratonPage = new RegistrationPage($driver);
        $registratonPage->open();
        $registratonPage->registration('danaflanders10924@gmail.com', 'DanaFlanders', 'qwerty0','qwerty02');
        $this->assertEquals("The passwords don't match, please try again.", $registratonPage->errorPassConfirm());
        
    }
}
