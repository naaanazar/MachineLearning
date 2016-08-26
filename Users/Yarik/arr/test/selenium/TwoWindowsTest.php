<?php

namespace Projarr\Test\Selenium;

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
//use Facebook\WebDriver\WebDriverKeys;
//use Projarr\Test\Selenium\Classes\ExpectedCondition;
//use Facebook\WebDriver\Remote\LocalFileDetector;

class TwoWindowsTest extends \PHPUnit_Framework_TestCase {
    
    protected $driver;

    public function testLogin ()
    {
//        $this->driver = RemoteWebDriver::create('http://192.168.0.105:9515', DesiredCapabilities::chrome());
        $this->driver = RemoteWebDriver::create('http://192.168.1.156:9515', DesiredCapabilities::chrome());
        $this->driver->manage()->window()->maximize(); //відкриває сторінку на повний екран
        $this->driver->get('https://crowdin.com');

        $element = $this->driver->findElement(WebDriverBy::linkText('Log in'));//пошук кнопок на сторінці linkText || xpath || cssSelector || name || className || id
        $element->click(); //клік

        $userNameInput = $this->driver->findElement(WebDriverBy::id('login_login')); //знаходим поле логіну
        $userNameInput->sendKeys('oyarik3@gmail.com'); //вводим логін

        $userPasswordInput = $this->driver->findElement(WebDriverBy::id('login_password')); //знаходим поле пароля
        $userPasswordInput->sendKeys('1q2w#E$R'); //вводим пароль

        $logIn = $this->driver->findElement(WebDriverBy::xpath("//*[@id='login_form']/fieldset/button"));
        $logIn->click();

        $this->driver->wait()->until(WebDriverExpectedCondition::titleIs("oyarik3's Profile - Users at Crowdin"));
        $this->assertEquals('https://crowdin.com/profile', $this->driver->getCurrentURL()); // getCurrentURL() - повертає url поточної сторінки

        $this->openProj();
//        $this->driver->quit(); //закриває браузер
    }

    public function openProj()
    {
        $setings = $this->driver->findElement(WebDriverBy::xpath("//*[@id='project-196118']/div/div/div/div/div[3]/div/div[3]/a"));
        $setings->click();
        $translate = $this->driver->findElement(WebDriverBy::xpath("//*[@id='tabs-list']/li[4]"));
        $translate->click();
        
        $inviteTranslators = $this->driver->findElement(WebDriverBy::id('invite_translators'));
        $inviteTranslators->click();

        $otherWaysLink = $this->driver->findElement(WebDriverBy::id('other-ways-link'));
        $otherWaysLink->click();

        $socialMediaInvitation = $this->driver->findElement(WebDriverBy::xpath("//*[@id='invite_translators_tabs']/ul/li[2]"));
        $socialMediaInvitation->click();

        $current_handle = $this->driver->getWindowHandle(); //запам’ятовуєи попочну вкладку (вікно)

        $googleShare = $this->driver->findElement(WebDriverBy::xpath("//*[@id='invite_translators_social_networks']/div/div/div/a[4]"));
        $googleShare->click();

        $this->driver->switchTo()->window(end($this->driver->getWindowHandles()));

        $this->driver->wait()->until(WebDriverExpectedCondition::titleIs("Google+"));

        $userEmail = $this->driver->findElement(WebDriverBy::id('Email'));
        $userEmail->clear();
        $userEmail->sendKeys('galcol53@gmail.com'); //вводим логін

        $next = $this->driver->findElement(WebDriverBy::id('next'));
        $next->click();

        $this->driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id('Passwd'))); //чекаєм на поле паролю

        $userPassword = $this->driver->findElement(WebDriverBy::id('Passwd'));
        $userPassword->clear();
        $userPassword->sendKeys('1q2w#E$R');



        $submit = $this->driver->findElement(WebDriverBy::id('signIn'));
        $submit->click();

        $this->driver->wait()->until(WebDriverExpectedCondition::titleIs("Поделиться в Google+")); //чекаємо на заголовок сторінки

        $massegeGoogle = $this->driver->findElement(WebDriverBy::id(':0.f'));
        $massegeGoogle->clear();
        $massegeGoogle->sendKeys('text test');
        $cancel = $this->driver->findElement(WebDriverBy::xpath("/html/body/div[1]/div[2]/div[2]/table/tbody/tr/td[1]/div[2]"));
        $cancel->click();


        $this->driver->switchTo()->window($current_handle);

        $cancelSetings = $this->driver->findElement(WebDriverBy::xpath("/html/body/div[20]/div[3]/div/button[1]"));
        $cancelSetings->click();
        $this->driver->quit();
    }
}
