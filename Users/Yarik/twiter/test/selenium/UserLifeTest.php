<?php

namespace Projarr\Test\Selenium;

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverKeys;
//use Projarr\Test\Selenium\Classes\ExpectedCondition;

class UserLifeTest extends \PHPUnit_Framework_TestCase {

    protected static $driver;

    public function setUp()
    {
//        $this->driver = RemoteWebDriver::create('http://192.168.0.105:9515', DesiredCapabilities::chrome());
//        $this->driver->get('https://crowdin.com'); //відкриває сторінку
    }

    public function setUpBeforeClass() {
        //викликається один раз перед всіма тестами
    }

    public function testRegistrationUser()
    {
//        $this->driver = RemoteWebDriver::create('http://192.168.0.105:9515', DesiredCapabilities::chrome());
        self::$driver = RemoteWebDriver::create('http://192.168.1.156:9515', DesiredCapabilities::chrome());
        self::$driver->manage()->window()->maximize(); //відкриває сторінку на повний екран
        self::$driver->get('https://crowdin.com');
//------------------------------------------------------------------------------
        $this->RegistrationUser();
        $this->CreareProject();
        $this->RenameProject();
        $this->RenameUser();
        $this->RemuveAccaunt();

        $this->driver->quit();
    }

    public function RegistrationUser() {
//        $this->driver->get('https://crowdin.com');

        $element = $this->driver->findElement(WebDriverBy::xpath("//*[@id='header-menu']/form/div/div/a[2]"));
        $element->click(); //клік

        $userNameInput = $this->driver->findElement(WebDriverBy::id('join_email')); //знаходим поле логіну
        $userNameInput->clear();
        $userNameInput->sendKeys('oyarik1@gmail.com'); //вводим логін

        $userLoginInput = $this->driver->findElement(WebDriverBy::id('join_login'));
        $userLoginInput->clear(); //вводим пароль
        $userLoginInput->sendKeys('oyarikq'); //вводим пароль

        $userPasswordInput = $this->driver->findElement(WebDriverBy::id('join_password')); //знаходим поле пароля
        $userPasswordInput->clear();
        $userPasswordInput->sendKeys('1q2w#E$R'); //вводим пароль

        $userPasswordConfirmationInput = $this->driver->findElement(WebDriverBy::id('join_password_confirmation')); //знаходим поле пароля
        $userPasswordConfirmationInput->clear();
        $userPasswordConfirmationInput->sendKeys('1q2w#E$R'); //вводим пароль

        $createAccount = $this->driver->findElement(WebDriverBy::xpath("//*[@id='join_form']/fieldset/button"));
        $createAccount->click();

        //$this->driver->wait()->until(WebDriverExpectedCondition::titleIs("oyarik's Profile - Users at Crowdin"));
        //$this->assertEquals('https://crowdin.com/profile', $this->driver->getCurrentURL()); // getCurrentURL() - повертає url поточної сторінки
    }

    public function CreareProject()
    {
//        створення проекту
//        $this->driver->get('https://crowdin.com/createproject');
        
        sleep(2);

        $createProject = $this->driver->findElement(WebDriverBy::xpath("//*[@id='instruction-for-creating-projects']/div/div/div[1]/div/div/a[1]"));
        $createProject->click();

        $projectName = $this->driver->findElement(WebDriverBy::id('project_name'));
        $projectName->clear();
        $name = 'qwerty'.rand(0, 10000);
        $projectName->sendKeys($name); //вводим логін

        $selectLenguage = $this->driver->findElement(WebDriverBy::xpath("//*[@id='project_source_language_chzn']/a/span"));
        $selectLenguage->click();
        $selectLeng = $this->driver->findElement(WebDriverBy::xpath("//*[@id='project_source_language_chzn']/div/div/input"));
        $selectLeng->sendKeys('Ukraine');

        $keyboard =  $this->driver->getKeyBoard();
        $keyboard->sendKeys(array(WebDriverKeys::ENTER));

        $selectLenguageTarget1 = $this->driver->findElement(WebDriverBy::xpath("//*[@id='target_languages_list']/div/ul/li[2]"));
        $selectLenguageTarget1->click();
        $selectLenguageTarget2 = $this->driver->findElement(WebDriverBy::xpath("//*[@id='target_languages_list']/div/ul/li[5]"));
        $selectLenguageTarget2->click();

        
        $createProjectFinish = $this->driver->findElement(WebDriverBy::id('create_project'));
        $createProjectFinish->click();

        sleep(5);

        $addSample = $this->driver->findElement(WebDriverBy::xpath("//*[@id='project_files_list']/div/div/div/div[3]/div[2]/p[1]/a"));
        $addSample->click();
        
        sleep(2);

        $translations = $this->driver->findElement(WebDriverBy::xpath("//*[@id='tabs-list']/li[2]/a"));
        $translations->click();


        $translationProgress = $this->driver->findElement(WebDriverBy::xpath("//*[@id='translation_progress']/tbody/tr[1]/td[1]/a"));
        $translationProgress->click();

        $openFile = $this->driver->findElement(WebDriverBy::xpath("//*[@id='node_2']/div/div[4]/a"));
        $openFile->click();

//        $this->driver->navigate()->back();
    }

    public function RenameProject()
    {
//        переіменування

        $menu = $this->driver->findElement(WebDriverBy::id('project-menu-item'));
        $menu->click();

        $setting = $this->driver->findElement(WebDriverBy::xpath("//*[@id='project-files-list']/li[4]/a"));
        $setting->click();

        sleep(2);

        $geleral = $this->driver->findElement(WebDriverBy::xpath("//*[@id='tabs-list']/li[1]/a"));
        $geleral->click();

        //$this->driver->get('https://crowdin.com/project/fdsf/settings#general');

        $newName = 'qwerty'.rand(0, 10000);

        $name = $this->driver->findElement(WebDriverBy::id('project_name'));
        $name->clear();
        $name->sendKeys($newName);
        sleep(5);
        $update = $this->driver->findElement(WebDriverBy::xpath("//*[@id='ps-general']/div/fieldset[1]/div[1]/div/div[1]/button"));
        $update->click();
        sleep(5);
        $goToProject = $this->driver->findElement(WebDriverBy::xpath("//*[@id='wrap']/div[6]/div/div[1]/div/a[3]"));
        $goToProject->click();
    }

    public function RenameUser()
    {
        // переіменування користувача

        sleep(2);
        $settingsMenu = $this->driver->findElement(WebDriverBy::xpath("//*[@id='settings-menu-item']/div"));
        $settingsMenu->click();

        $removeAccountMenu = $this->driver->findElement(WebDriverBy::xpath("//*[@id='account-settings-tabs']/li[1]/a"));
        $removeAccountMenu->click();

//        $this->driver->get('https://crowdin.com/settings#account');

        $realName = $this->driver->findElement(WebDriverBy::id("real_name"));
        //$realName->clear();
        sleep(5);
        $realName->sendKeys('Tasds');
        sleep(5);
        $updateRealName = $this->driver->findElement(WebDriverBy::xpath("//*[@id='user-profile-account']/form/div[1]/div/div/button"));
        $updateRealName->click();
        sleep(5);



    }

    public function RemuveAccaunt()
    {
        // видалення користувача

        sleep(2);
        $settingsMenu = $this->driver->findElement(WebDriverBy::xpath("//*[@id='settings-menu-item']/div"));
        $settingsMenu->click();

        $removeAccountMenu = $this->driver->findElement(WebDriverBy::xpath("//*[@id='account-settings-tabs']/li[9]/a"));
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
