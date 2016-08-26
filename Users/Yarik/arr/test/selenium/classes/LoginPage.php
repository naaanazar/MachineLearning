<?php

namespace Projarr\Test\Selenium\Classes;

use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverBy;

class LoginPage {
    
    protected $driver;

    public function __construct($driver)
    {
        $this->driver = $driver;
    }

    public function open()
    {
        return $this->driver->get('https://crowdin.com/login');
    }

    public function login($login, $password)
    {
        $userNameInput = $this->driver->findElement(WebDriverBy::id('login_login')); //знаходим поле логіну
        $userNameInput->sendKeys($login); //вводим логін

        $userPasswordInput = $this->driver->findElement(WebDriverBy::id('login_password')); //знаходим поле пароля
        $userPasswordInput->sendKeys($password); //вводим пароль

        $logIn = $this->driver->findElement(WebDriverBy::xpath("//*[@id='login_form']/fieldset/button"));
        $logIn->click();
    }

    public function getError()
    {
        $this->driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::id("login_failed_block")));
        $error = $this->driver->findElement(WebDriverBy::xpath('//*[@id="login_failed_block"]'));

        return $error->getText();
    }
}
