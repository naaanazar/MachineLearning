<?php

namespace Projarr\Test\Selenium;

use Projarr\Test\Selenium\Classes\LoginPage;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;

class ClassLoginPageTest extends \PHPUnit_Framework_TestCase {

    public function setUp()
    {
//        $this->driver = RemoteWebDriver::create('http://192.168.45.109:9515', DesiredCapabilities::chrome());
        $this->driver = RemoteWebDriver::create('http://192.168.2.133:9515', DesiredCapabilities::chrome());
//        $this->driver = RemoteWebDriver::create('http://192.168.0.105:9515', DesiredCapabilities::chrome());
        $this->driver->manage()->window()->maximize(); //відкриває сторінку на повний екран
        $this->driver->get('https://crowdin.com');
    }

    public function testLoginTrue()
    {
        $loginPage = new LoginPage($this->driver);
        $loginPage->open();
        $loginPage->login('oyarik3', '1q2w#E$R');

        $this->driver->wait()->until(WebDriverExpectedCondition::titleIs("oyarik3's Profile - Users at Crowdin"));

        $profilePageURL = "https://crowdin.com/profile";
        $actualProfilePageURL = $this->driver->getCurrentURL();
        $this->assertEquals($profilePageURL, $actualProfilePageURL);
    }

    public function testErrorPassword()
    {
        $loginPage = new LoginPage($this->driver);
        $loginPage->open();
        $loginPage->login('oyarik3', 'Error Password');

//        $this->driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id("login_failed_block")));

        $loginPageErrorMsg = "Looks like that's not right. Give it another try?";
        $actualErrorMsg = $loginPage->getError();
        $this->assertEquals($loginPageErrorMsg, $actualErrorMsg);
    }

    public function testErrorLogin()
    {
        $loginPage = new LoginPage($this->driver);
        $loginPage->open();
        $loginPage->login('oyarik100000', '1q2w#E$R');

//        $this->driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id("login_failed_block")));
        
        $loginPageErrorMsg = "Looks like that's not right. Give it another try?";
        $actualErrorMsg = $loginPage->getError();
        $this->assertEquals($loginPageErrorMsg, $actualErrorMsg);
    }
}