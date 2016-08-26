<?php

namespace Projarr\Test\Selenium;

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

class SSOTest extends \PHPUnit_Framework_TestCase {
    protected $driver;

    public function testSSOGoogle()
    {
        $this->driver = RemoteWebDriver::create('http://192.168.1.156:9515', DesiredCapabilities::chrome());
        $this->driver->manage()->window()->maximize(); //відкриває сторінку на повний екран
        $this->driver->get('https://crowdin.com');

        $element = $this->driver->findElement(WebDriverBy::xpath("//*[@id='header-menu']/form/div/div/a[2]"));
        $element->click(); //клік

        $element = $this->driver->findElement(WebDriverBy::xpath("//*[@id='login-register-div']/div[2]/div[2]/div/a[3]/span"));
        $element->click(); //клік

        $userEmail = $this->driver->findElement(WebDriverBy::id('Email'));
        $userEmail->clear();
        $userEmail->sendKeys('galcol53@gmail.com'); //вводим логін

        $next = $this->driver->findElement(WebDriverBy::id('next'));
        $next->click();

        sleep(2);

        $userPassword = $this->driver->findElement(WebDriverBy::id('Passwd'));
        $userPassword->clear();
        $userPassword->sendKeys('1q2w#E$R');

        $submit = $this->driver->findElement(WebDriverBy::id('signIn'));
        $submit->click();

        sleep(2);

        $this->RemuveAccaunt();
    }

    public function RemuveAccaunt()
    {
        // видалення користувача

        sleep(2);
        $settingsMenu = $this->driver->findElement(WebDriverBy::xpath("//*[@id='settings-menu-item']/div"));
        $settingsMenu->click();

        $removeAccountMenu = $this->driver->findElement(WebDriverBy::xpath("//*[@id='account-settings-tabs']/li[8]/a"));
        $removeAccountMenu->click();

//        $this->driver->get('https://crowdin.com/settings#account');

        $removeUserAccount = $this->driver->findElement(WebDriverBy::id('remove_user_account'));
        $removeUserAccount->click();

        sleep(2);

        $deletingReasonText = $this->driver->findElement(WebDriverBy::id('deleting_reason_text'));
        $deletingReasonText->sendKeys('because');

        $removeAccount = $this->driver->findElement(WebDriverBy::xpath("/html/body/div[3]/div[3]/div/button[2]/span"));
        $removeAccount->click();

        $this->driver->wait()->until(WebDriverExpectedCondition::alertIsPresent());
        $this->driver->switchTo()->alert()->accept();
    }
}
