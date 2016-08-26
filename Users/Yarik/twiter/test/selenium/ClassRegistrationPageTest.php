<?php

namespace Projarr\Test\Selenium;

use Facebook\WebDriver\WebDriverExpectedCondition;
//use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Projarr\Test\Selenium\Classes\RegistrationPage;

class ClassRegistrationPageTest extends \PHPUnit_Framework_TestCase {
    
    public function setUp()
    {
//        $this->driver = RemoteWebDriver::create('http://192.168.45.109:9515', DesiredCapabilities::chrome());
        $this->driver = RemoteWebDriver::create('http://192.168.2.133:9515', DesiredCapabilities::chrome());
//        $this->driver = RemoteWebDriver::create('http://192.168.0.105:9515', DesiredCapabilities::chrome());
        $this->driver->manage()->window()->maximize(); //відкриває сторінку на повний екран
        $this->driver->get('https://crowdin.com');
    }

    public function testRegistrationTrue()
    {
        $registration = new RegistrationPage($this->driver);
        $registration->open();
        $registration->registration('oyarik4@gmail.com', 'oyarik4', '1q2w#E$R', '1q2w#E$R');

        $this->driver->wait()->until(WebDriverExpectedCondition::titleIs("oyarik4's Profile - Users at Crowdin"));

        $profilePageURL = "https://crowdin.com/profile";
        $actualProfilePageURL = $this->driver->getCurrentURL();
        $this->assertEquals($profilePageURL, $actualProfilePageURL);
    }

    public function testRegistrationUsingEmail()
    {
        $registration = new RegistrationPage($this->driver);
        $registration->open();
        $registration->registration('oyarik3@gmail.com', 'oyarik9999', '12345', '12345');

        $emailMessage = "Looks like this email is already registered by another user or you used it in a previous registration";
        $actualEmailMessage = $registration->getErrorEmailMessage();
        $this->assertEquals($emailMessage, $actualEmailMessage);
    }

    public function testRegistrationUsingLogin()
    {
        $registration = new RegistrationPage($this->driver);
        $registration->open();
        $registration->registration('oyarik9999@gmail.com', 'oyarik3', '12345', '12345');

        $loginMessage = "Looks like this login is already taken";
        $actualLoginMessage = $registration->getErrorLoginMessage();
        $this->assertEquals($loginMessage, $actualLoginMessage);
    }

    public function testRegistrationShortPassword()
    {
        $registration = new RegistrationPage($this->driver);
        $registration->open();
        $registration->registration('oyarik9999@gmail.com', 'oyarik9999', '12345', '12345');

        $passwordMessage = "Password is too short (minimum is 6 characters)";
        $actualPasswordMessage = $registration->getErrorShotPasswordMessage();
        $this->assertEquals($passwordMessage, $actualPasswordMessage);
    }

    public function testRegistrationPasswordFalse()
    {
        $registration = new RegistrationPage($this->driver);
        $registration->open();
        $registration->registration('oyarik999@gmail.com', 'oyarik999', '87654321', '12345678');

        $passwordConfirmationMessage = "The passwords don't match, please try again.";
        $actualConfirmationMessage = $registration->getErrorPasswordConfirmationMessage();
        $this->assertEquals($passwordConfirmationMessage, $actualConfirmationMessage);
    }
}
