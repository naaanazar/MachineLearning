<?php

namespace Projarr\Test\Selenium;

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverKeys;

class EditorShortCardsTest extends \PHPUnit_Framework_TestCase {
   
    protected $driver;

//    public function addDataProvider()
//    {
//        return array (
//            array ('http://192.168.1.156:9515', DesiredCapabilities::chrome())
//            //array ('http://192.168.1.156:4444/wd/hub', DesiredCapabilities::firefox())
//        );
//    }

//    public function tearDown()
//    {
//       // $this->driver->quit(); //закриває браузер
//    }

   

    public function testLogin ()
    {
        //$this->driver = RemoteWebDriver::create('http://192.168.1.156:9515', DesiredCapabilities::chrome());
        $this->driver = RemoteWebDriver::create('http://192.168.0.105:9515', DesiredCapabilities::chrome());
        $this->driver->manage()->window()->maximize(); //відкриває сторінку на повний екран
        $this->driver->get('https://crowdin.com');
        
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
//--------------------------------------------------------------------------------------------
        $openProj = $this->driver->findElement(WebDriverBy::xpath("//*[@id='project-195580']/div/div/div/div/div[1]/div/a/span"));
        $openProj->click();

        $selectLeng = $this->driver->findElement(WebDriverBy::xpath("//*[@id='wrap']/div[4]/div/div/div[1]/div[2]/div/ins[1]/div/div/a"));
        $selectLeng->click();

        $selectFile = $this->driver->findElement(WebDriverBy::xpath("//*[@id='node_2']/div/div[4]/a"));
        $selectFile->click();

        $this->driver->wait()->until(WebDriverExpectedCondition::titleIs('crowdin_sample_android.xml - EditorShortCardsTest - Crowdin translation'));

//        $this->driver->navigate()->back(); //сторінка назад
//        $this->driver->navigate()->forward(); //сторінка вперед

//        $selectFile1 = $this->driver->findElement(WebDriverBy::xpath("//*[@id='phrase_31']/a"));
//        $selectFile1->click();


        $keyboard =  $this->driver->getKeyBoard();

//        $keyboard->sendKeys(array(WebDriverKeys::ALT, 'c'));

//        

  

        $keyboard->pressKey(WebDriverKeys::ALT); //натиснути Alt
        $keyboard->pressKey("c"); //натиснути 'c'
        sleep(1);
        $keyboard->releaseKey("c"); //відпустити 'c'
        $keyboard->releaseKey(WebDriverKeys::ALT); //відпустити Alt

        $welcome1 = $this->driver->findElement(WebDriverBy::id("source_phrase_container"));
        $welcome2 = $this->driver->findElement(WebDriverBy::id("translation"));

        $a = $welcome1->getText();
        $b = $welcome2->getAttribute('value');
        $this->assertEquals($a, $b);

        
//        sleep(1);

//        $keyboard->sendKeys(array(WebDriverKeys::CONTROL, WebDriverKeys::ENTER));


        $keyboard->pressKey(WebDriverKeys::CONTROL); //натиснути Alt
        $keyboard->pressKey(WebDriverKeys::ENTER); //натиснути 'c'
        sleep(1);
        $keyboard->releaseKey(WebDriverKeys::ENTER); //відпустити 'c'
        $keyboard->releaseKey(WebDriverKeys::CONTROL); //відпустити Alt

//        $keyboard->pressKey(WebDriverKeys::ALT); //натиснути Alt
//        $keyboard->pressKey("c"); //натиснути 'c'
//        sleep(2);
//        $keyboard->releaseKey("c"); //відпустити 'c'
//        $keyboard->releaseKey(WebDriverKeys::ALT); //відпустити Alt
//
//        $saveAs1 = $this->driver->findElement(WebDriverBy::id("source_phrase_container"));
//        $saveAs2 = $this->driver->findElement(WebDriverBy::id("translation"));
//
//        $aa = $saveAs1->getText();
//        $bb = $saveAs2->getAttribute('value');
//        $this->assertEquals($aa, $bb);

//        $this->driver->quit(); //закриває браузер
    }

//    public function testKeybord ()
//    {
//        //$this->driver->get('https://crowdin.com/translate/editorshortcardstest/2/uk-ach');
//
//        //$keyboard =  $this->driver->getKeyBoard();
//
//        $openProj = $this->driver->findElement(WebDriverBy::xpath("//*[@id='project-195580']/div/div/div/div/div[1]/div/a/span"));
//        $openProj->click();
//
//        //*[@id="profile-filter-projects-links"]/a[1]
//
////        $element1 = $this->driver->findElement(WebDriverBy::xpath("//*[@id='project-195580']/div/div/div/div/div[1]/div/a/span"));
////        $element1->click();
////
////        $element2 = $this->driver->findElement(WebDriverBy::xpath("//li[@id='project-195580']//a[@data-toggle='dropdown']"));
////        $element2->click();
//
////        $element4 = $this->driver->findElement(WebDriverBy::xpath("//*[@id='wrap]/div[4]/div/div/div[1]/div[2]/div/ins[1]/div/div/a"));
////        $element4->click();
////        $this->driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath("//*[@id='node_2']/div/div[4]/a")));
//
//        $element5 = $this->driver->findElement(WebDriverBy::xpath("//*[@id='node_2']/div/div[4]/a"));
//        $element5->click();
//
////        $element2 = $this->driver->findElement(WebDriverBy::xpath(""));
////        $element2->click();
//
//
//
//
//
//
//
//
//
//        $keyboard->pressKey(WebDriverKeys::CTRl); //натиснути Ctrl
//        $keyboard->pressKey('C'); //натиснути 'C'
//        sleep(2);
//        $keyboard->realeseKey(WebDriverKeys::CTRl); //відпустити Ctrl
//        $keyboard->realeseKey('C'); //відпустити 'C'
//    }

}
