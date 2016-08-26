<?php

namespace Projarr\Test\Selenium;

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

class SeleniumTestRegistrationTest extends \PHPUnit_Framework_TestCase {

    protected $driver;

    public function setUp()
    {
        //відкриваєм головну сторінку
//        $host = 'http://192.168.1.156:4444/wd/hub';
//        $this->driver = RemoteWebDriver::create($host, DesiredCapabilities::firefox());
        $this->driver = RemoteWebDriver::create('http://192.168.1.156:4444/wd/hub', DesiredCapabilities::firefox());
        $this->driver->get('https://crowdin.com'); //відкриває сторінку
    }

    public function tearDown()
    {
        //закриваєм браузер
        $this->driver->quit(); //закриває браузер
    }

    public function testRegistration ()
    {
        //$element = $this->driver->findElement(WebDriverBy::linkText('Sing up'));//пошук кнопок на сторінці linkText || xpath || cssSelector || name || className || id
        $element = $this->driver->findElement(WebDriverBy::xpath("//*[@id='header-menu']/form/div/div/a[2]"));
        $element->click(); //клік

        $userNameInput = $this->driver->findElement(WebDriverBy::id('join_email')); //знаходим поле логіну
        $userNameInput->clear();
        $userNameInput->sendKeys('oyarik3@gmail.com'); //вводим логін

        $userLoginInput = $this->driver->findElement(WebDriverBy::id('join_login'));
        $userLoginInput->clear(); //вводим пароль
        $userLoginInput->sendKeys('oyarikqwe'); //вводим пароль

        $userPasswordInput = $this->driver->findElement(WebDriverBy::id('join_password')); //знаходим поле пароля
        $userPasswordInput->clear();
        $userPasswordInput->sendKeys('1q2w#E$R'); //вводим пароль

        $userPasswordConfirmationInput = $this->driver->findElement(WebDriverBy::id('join_password_confirmation')); //знаходим поле пароля
        $userPasswordConfirmationInput->clear();
        $userPasswordConfirmationInput->sendKeys('1q2w#E$R'); //вводим пароль

        $createAccount = $this->driver->findElement(WebDriverBy::xpath("//*[@id='join_form']/fieldset/button"));
        $createAccount->click();

        $this->driver->wait()->until(WebDriverExpectedCondition::titleIs("oyarik's Profile - Users at Crowdin"));
        $this->assertEquals('https://crowdin.com/profile', $this->driver->getCurrentURL()); // getCurrentURL() - повертає url поточної сторінки

        //$this->assertEquals('https://crowdin.com/settings#account', $this->driver->getCurrentURL());
        //$openSettingsLoginInput = $this->driver->wait(5, 300)->findElement(WebDriverBy::className("static-icon.static-icon-cog"));
        
                //xpath("//*[@id='settings-menu-item']/div"));
        $openSettingsLoginInput = $this->driver->findElement(WebDriverBy::xpath("//*[@id='settings-menu-item']/div"));
        $openSettingsLoginInput->click();
        $this->driver->wait()->until(WebDriverExpectedCondition::titleIs("oyarik Account Settings - Crowdin"));
        
        $removeAccount = $this->driver->wait()->findElement(WebDriverBy::xpath("//*[@id='account-settings-tabs']/li[8]/a"));
        $removeAccount->click();

        $removeAccountMassege = $this->driver->wait()->findElement(WebDriverBy::id('remove_user_account'));
        $removeAccountMassege->click();
        $removeAccountMassege->sendKeys('proba');

        $removeAccountConfirmation = $this->driver->wait()->findElement(WebDriverBy::xpath("/html/body/div[3]/div[3]/div/button[2]"));
        $removeAccountConfirmation->click();
    }
}