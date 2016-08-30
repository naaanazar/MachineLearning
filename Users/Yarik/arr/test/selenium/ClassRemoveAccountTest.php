<?php

namespace Projarr\Test\Selenium;

use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Projarr\Test\Selenium\Classes\RegistrationPage;
use Projarr\Test\Selenium\Classes\RemoveAccount;
use Projarr\Test\Selenium\Classes\LoginPage;

use Projarr\Test\Selenium\Classes\ProjectWork;

class ClassRemoveAccountTest extends \PHPUnit_Framework_TestCase {

    protected $login = 'oyarik13212312';
    protected $pass = '1q2w#E$R';
    protected $email = '@gmail.com';

    public function setUp()
    {
//        $this->driver = RemoteWebDriver::create('http://192.168.45.109:9515', DesiredCapabilities::chrome());
        $this->driver = RemoteWebDriver::create('http://192.168.1.156:9515', DesiredCapabilities::chrome());
//        $this->driver = RemoteWebDriver::create('http://192.168.0.105:9515', DesiredCapabilities::chrome());
        $this->driver->manage()->window()->maximize(); //відкриває сторінку на повний екран
        $this->driver->get('https://crowdin.com');
    }
    
    public function testCreateAndRemoveAccount() {
        $createAccount = new RegistrationPage($this->driver);
        $loginAccount = new LoginPage($this->driver);
        $removeAccount = new RemoveAccount($this->driver);
        $createProject = new ProjectWork($this->driver);

        $createAccount->open();
        $createAccount->registration($this->login . $this->email, $this->login, $this->pass, $this->pass);

        $loginAccount->open();
        $loginAccount->login($this->login, $this->pass);

        $titleProfile = $this->login."'s Profile - Users at Crowdin";
        $this->driver->wait()->until(WebDriverExpectedCondition::titleIs($titleProfile));

        $createProject->open();
        $createProject->createProject();
        $createProject->renameProject();

        $removeAccount->open();
        $removeAccount->remuveAccount();

        $this->assertEquals('https://crowdin.com/', $this->driver->getCurrentURL());
        }
}
