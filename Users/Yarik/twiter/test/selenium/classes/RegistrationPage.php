<?php

namespace Projarr\Test\Selenium\Classes;

use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverBy;

class RegistrationPage
{
    protected $driver;

    public function __construct($driver)
    {
        $this->driver = $driver;
    }

    public function open()
    {
        return $this->driver->get('https://crowdin.com/join');
    }

    public function registration($email, $login, $password, $passwordComfirmation)
    {
        $userEmail = $this->driver->findElement(WebDriverBy::id('join_email')); //знаходим поле логіну
        $userEmail->clear();
        $userEmail->sendKeys($email); //вводим логін

        $userLogin = $this->driver->findElement(WebDriverBy::id('join_login'));
        $userLogin->clear(); //вводим пароль
        $userLogin->sendKeys($login); //вводим пароль

        $userPasswordInput = $this->driver->findElement(WebDriverBy::id('join_password')); //знаходим поле пароля
        $userPasswordInput->clear();
        $userPasswordInput->sendKeys($password); //вводим пароль

        $userPasswordConfirmationInput = $this->driver->findElement(WebDriverBy::id('join_password_confirmation')); //знаходим поле пароля
        $userPasswordConfirmationInput->clear();
        $userPasswordConfirmationInput->sendKeys($passwordComfirmation); //вводим пароль

        $createAccount = $this->driver->findElement(WebDriverBy::xpath("//*[@id='join_form']/fieldset/button"));
        $createAccount->click();
    }

    public function getErrorEmailMessage()
    {

        $this->driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::id("join_email_message")));
        $error = $this->driver->findElement(WebDriverBy::xpath('//*[@id="join_email_message"]'));
        return $error->getText();
    }

    public function getErrorLoginMessage()
    {
        $this->driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::id("join_login_message")));
        $error = $this->driver->findElement(WebDriverBy::xpath('//*[@id="join_login_message"]'));
        return $error->getText();
    }

    public function getErrorShotPasswordMessage()
    {
        $this->driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::id("join_password_message")));
        $error = $this->driver->findElement(WebDriverBy::xpath('//*[@id="join_password_message"]'));
        return $error->getText();
    }
    
    public function getErrorPasswordConfirmationMessage()
    {
        $this->driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::id("join_password_confirmation_message")));
        $error = $this->driver->findElement(WebDriverBy::xpath('//*[@id="join_password_confirmation_message"]'));
        return $error->getText();
    }
}