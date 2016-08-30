<?php

namespace Projarr\Test\Selenium;

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

class SeleniumTest extends \PHPUnit_Framework_TestCase {

    protected $driver;

    public function setUp()
    {
        //$host = 'http://192.168.1.156:4444/wd/hub';
        $this->driver = RemoteWebDriver::create('http://192.168.0.105:9515', DesiredCapabilities::chrome());
        //$this->driver = RemoteWebDriver::create('http://192.168.1.156:4444/wd/hub', DesiredCapabilities::firefox());
        $this->driver->get('https://crowdin.com'); //відкриває сторінку
    }

    public function tearDown()
    {
        $this->driver->quit(); //закриває браузер
    }

    public function testLogin ()
    {
        $element = $this->driver->findElement(WebDriverBy::linkText('Log in'));//пошук кнопок на сторінці linkText || xpath || cssSelector || name || className || id
        $element->click(); //клік

        $userNameInput = $this->driver->findElement(WebDriverBy::id('login_login')); //знаходим поле логіну
        $userNameInput->sendKeys('oyarik@gmail.com'); //вводим логін

        $userPasswordInput = $this->driver->findElement(WebDriverBy::id('login_password')); //знаходим поле пароля
        $userPasswordInput->sendKeys('1q2w#E$R'); //вводим пароль

        $logIn = $this->driver->findElement(WebDriverBy::xpath("//*[@id='login_form']/fieldset/button"));
        $logIn->click();

        $this->driver->wait()->until(WebDriverExpectedCondition::titleIs("oyarik's Profile - Users at Crowdin"));
        $this->assertEquals('https://crowdin.com/profile', $this->driver->getCurrentURL()); // getCurrentURL() - повертає url поточної сторінки

        //$this->driver->quit(); //закриває браузер
    }

    public function testErrorLoginAndPassword ()
    {
        $element = $this->driver->findElement(WebDriverBy::linkText('Log in'));//пошук кнопок на сторінці linkText || xpath || cssSelector || name || className || id
        $element->click(); //клік

        $userNameInput = $this->driver->findElement(WebDriverBy::id('login_login')); //знаходим поле логіну
        $userNameInput->sendKeys('oyarik1@gmail.com'); //вводим логін

        $userPasswordInput = $this->driver->findElement(WebDriverBy::id('login_password')); //знаходим поле пароля
        $userPasswordInput->sendKeys('1q'); //вводим пароль

        $logIn = $this->driver->findElement(WebDriverBy::xpath("//*[@id='login_form']/fieldset/button"));
        $logIn->click();

        $this->driver->wait()->until(WebdriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath('//*[@id="login_failed_block"]'))); //перевірка чи вискакує повідомлення

//        $this->driver->wait()->until(WebDriverExpectedCondition::titleIs("oyarik's Profile - Users at Crowdin"));
//        $this->assertEquals('https://crowdin.com/profile', $this->driver->getCurrentURL()); // getCurrentURL() - повертає url поточної сторінки
    }

    public function testErrorLogin ()
    {
        $element = $this->driver->findElement(WebDriverBy::linkText('Log in'));//пошук кнопок на сторінці linkText || xpath || cssSelector || name || className || id
        $element->click(); //клік

        $userNameInput = $this->driver->findElement(WebDriverBy::id('login_login')); //знаходим поле логіну
        $userNameInput->sendKeys('oyarik1@gmail.com'); //вводим логін

        $userPasswordInput = $this->driver->findElement(WebDriverBy::id('login_password')); //знаходим поле пароля
        $userPasswordInput->sendKeys('1q2w#E$R'); //вводим пароль

        $logIn = $this->driver->findElement(WebDriverBy::xpath("//*[@id='login_form']/fieldset/button"));
        $logIn->click();

        $this->driver->wait()->until(WebdriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath('//*[@id="login_failed_block"]'))); //перевірка чи вискакує повідомлення

//        $this->driver->wait()->until(WebDriverExpectedCondition::titleIs("oyarik's Profile - Users at Crowdin"));
//        $this->assertEquals('https://crowdin.com/profile', $this->driver->getCurrentURL()); // getCurrentURL() - повертає url поточної сторінки
    }

    public function testErrorPassword ()
    {
        $element = $this->driver->findElement(WebDriverBy::linkText('Log in'));//пошук кнопок на сторінці linkText || xpath || cssSelector || name || className || id
        $element->click(); //клік

        $userNameInput = $this->driver->findElement(WebDriverBy::id('login_login')); //знаходим поле логіну
        $userNameInput->sendKeys('oyarik@gmail.com'); //вводим логін

        $userPasswordInput = $this->driver->findElement(WebDriverBy::id('login_password')); //знаходим поле пароля
        $userPasswordInput->sendKeys('123456'); //вводим пароль

        $logIn = $this->driver->findElement(WebDriverBy::xpath("//*[@id='login_form']/fieldset/button"));
        $logIn->click();

        $this->driver->wait()->until(WebdriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath('//*[@id="login_failed_block"]'))); //перевірка чи вискакує повідомлення

//        $this->driver->wait()->until(WebDriverExpectedCondition::titleIs("oyarik's Profile - Users at Crowdin"));
//        $this->assertEquals('https://crowdin.com/profile', $this->driver->getCurrentURL()); // getCurrentURL() - повертає url поточної сторінки
    }

    public function testEmptyLoginAndPassword ()
    {
        $element = $this->driver->findElement(WebDriverBy::linkText('Log in'));//пошук кнопок на сторінці linkText || xpath || cssSelector || name || className || id
        $element->click(); //клік

        $userNameInput = $this->driver->findElement(WebDriverBy::id('login_login')); //знаходим поле логіну
        $userNameInput->clear(); //очищуєм поле логіну

        $userPasswordInput = $this->driver->findElement(WebDriverBy::id('login_password')); //знаходим поле пароля
        $userPasswordInput->clear(); //очищуєм поле паролю

        $logIn = $this->driver->findElement(WebDriverBy::xpath("//*[@id='login_form']/fieldset/button"));
        $logIn->click();

        $this->driver->wait()->until(WebdriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath('//*[@id="login_failed_block"]'))); //перевірка чи вискакує повідомлення

//        $this->driver->wait()->until(WebDriverExpectedCondition::titleIs("oyarik's Profile - Users at Crowdin"));
//        $this->assertEquals('https://crowdin.com/profile', $this->driver->getCurrentURL()); // getCurrentURL() - повертає url поточної сторінки
    }

     public function testPassword ()
    {
        $element = $this->driver->findElement(WebDriverBy::linkText('Log in'));//пошук кнопок на сторінці linkText || xpath || cssSelector || name || className || id
        $element->click(); //клік

        $userNameInput = $this->driver->findElement(WebDriverBy::id('login_login')); //знаходим поле логіну
        $userNameInput->sendKeys('oyarik1@gmail.com'); //очищуєм поле логіну

        $userPasswordInput = $this->driver->findElement(WebDriverBy::id('login_password')); //знаходим поле пароля
        $userPasswordInput->clear(); //очищуєм поле паролю

        $logIn = $this->driver->findElement(WebDriverBy::xpath("//*[@id='login_form']/fieldset/button"));
        $logIn->click();

        $this->driver->wait()->until(WebdriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath('//*[@id="login_failed_block"]'))); //перевірка чи вискакує повідомлення

//        $this->driver->wait()->until(WebDriverExpectedCondition::titleIs("oyarik's Profile - Users at Crowdin"));
//        $this->assertEquals('https://crowdin.com/profile', $this->driver->getCurrentURL()); // getCurrentURL() - повертає url поточної сторінки
    }

     public function testEmptyLogin ()
    {
        $element = $this->driver->findElement(WebDriverBy::linkText('Log in'));//пошук кнопок на сторінці linkText || xpath || cssSelector || name || className || id
        $element->click(); //клік

        $userNameInput = $this->driver->findElement(WebDriverBy::id('login_login')); //знаходим поле логіну
        $userNameInput->clear(); //очищуєм поле логіну

        $userPasswordInput = $this->driver->findElement(WebDriverBy::id('login_password')); //знаходим поле пароля
        $userPasswordInput->sendKeys('1q2w#E$R'); //очищуєм поле паролю

        $logIn = $this->driver->findElement(WebDriverBy::xpath("//*[@id='login_form']/fieldset/button"));
        $logIn->click();

        $this->driver->wait()->until(WebdriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath('//*[@id="login_failed_block"]'))); //перевірка чи вискакує повідомлення

//        $this->driver->wait()->until(WebDriverExpectedCondition::titleIs("oyarik's Profile - Users at Crowdin"));
//        $this->assertEquals('https://crowdin.com/profile', $this->driver->getCurrentURL()); // getCurrentURL() - повертає url поточної сторінки
    }

//      $this->driver->wait()->until(WebdriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath('//*[@id="login_failed_block"]'))); //перевірка чи вискакує повідомлення

//    public function testOpen ()
//    {
//
////        $host = 'http://192.168.1.156:4444/wd/hub';
////        $driver = RemoteWebDriver::create($host, DesiredCapabilities::firefox());
////        $this->driver->get('https://crowdin.com'); //відкриває сторінку
//
//
////        $this->setOpen($driver);
//
//        $element = $this->driver->findElement(WebDriverBy::linkText('Log in'));//пошук кнопок на сторінці linkText || xpath || cssSelector || name || className || id
//        $element->click(); //клік
//
////        $this->assertEquals('https://crowdin.com/login', $driver->getCurrentURL()); // getCurrentURL() - повертає url поточної сторінки
////        $this->assertEquals('Log in - Crowdin', $driver->getTitle()); // getTitle() - повертає Title поточної сторінки
//
////        $driver->get('https://crowdin.com/login'); //відкриває сторінку
//
//        $userNameInput = $this->driver->findElement(WebDriverBy::id('login_login')); //знаходим поле логіну
//        $userNameInput->sendKeys('oyarik@gmail.com'); //вводим логін
//
//        $userPasswordInput = $this->driver->findElement(WebDriverBy::id('login_password')); //знаходим поле пароля
//        $userPasswordInput->sendKeys('1q2w#E$R'); //вводим пароль
//
//        $logIn = $this->driver->findElement(WebDriverBy::xpath("//*[@id='login_form']/fieldset/button"));
//        $logIn->click();
//
//        $this->assertEquals('https://crowdin.com/profile', $driver->getCurrentURL()); // getCurrentURL() - повертає url поточної сторінки
//
//        $this->driver->wait()->until(WebDriverExpectedCondition::titleIs("oyarik's Profile - Users at Crowdin"));
//
////        $this->assertEquals("oyarik's Profile - Users at Crowdin", $driver->getTitle()); // getTitle() - повертає Title поточної сторінки
////        $driver->wait()->until(WebdriverExpectedCondition::titleIs('title')); // очікує на
////        $driver->quit(); //закриває браузер
//    }
}