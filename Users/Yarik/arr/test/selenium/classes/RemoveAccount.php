<?php

namespace Projarr\Test\Selenium\Classes;

use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverBy;

class RemoveAccount {

    protected $driver;

    public function __construct($driver)
    {
        $this->driver = $driver;
    }

    public function open()
    {
        return $this->driver->get('https://crowdin.com/settings#remove-account');
    }

    public function remuveAccount()
    {
        $removeUserAccount = $this->driver->findElement(WebDriverBy::id('remove_user_account'));
        $removeUserAccount->click();

        $this->driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::id("deleting_reason_text")));

        $deletingReasonText = $this->driver->findElement(WebDriverBy::id('deleting_reason_text'));
        $deletingReasonText->sendKeys('because');

        $removeAccount = $this->driver->findElement(WebDriverBy::xpath("/html/body/div[3]/div[3]/div/button[2]/span"));
        $removeAccount->click();

        $this->driver->wait()->until(WebDriverExpectedCondition::alertIsPresent());
        $this->driver->switchTo()->alert()->accept();

        $this->driver->wait()->until(WebDriverExpectedCondition::titleIs("Localization Management Platform: collaborative internationalization and easy to use translation system - Crowdin"));

    }
}
