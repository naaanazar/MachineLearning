<?php

namespace liw\Test\Selenium;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverKeys;

class EditorShortCartTest extends \PHPUnit_Framework_TestCase
{
    protected $driver;

    public function setUp()
    {
        $host = 'http://192.168.1.153:9515';
        $this->driver = RemoteWebDriver::create($host, DesiredCapabilities::chrome());
        $this->driver->manage()->window()->maximize();
        $this->driver->get('https://crowdin.com');
    }

    public function tearDown()
    {
        $this->driver->quit();
    }
    
    public function testOpenSuccsess()
    {
        
        
        $keyboard =  $this->driver->getKeyBoard();
        $element = $this->driver->findElement(WebDriverBy::linkText('Log in'));
        $element->click();

        $this->assertEquals('https://crowdin.com/login', $this->driver->getCurrentURL());
        $this->assertEquals('Log In - Crowdin', $this->driver->getTitle());

        $loginInput = $this->driver->findElement(WebDriverBy::id('login_login'));
        $loginInput->sendKeys("NataliaRich");

        $passwordInput = $this->driver->findElement(WebDriverBy::id('login_password'));
        $passwordInput->sendKeys("qwerty03");

        $focusedElement = $this->driver->findElement(WebDriverBy::xpath("//*[@id='login_form']/fieldset/button"));
        $focusedElement->click();
        
        $projectClick = $this->driver->findElement(WebDriverBy::xpath("//*[@id='project-195567']/div/div/div/div/div[1]/div/a"));
        $projectClick->click();

        $translateClick = $this->driver->findElement(WebDriverBy::xpath("//*[@id='wrap']/div[4]/div/div/div[1]/div[2]/div/ins[1]/div/div/div/strong"));
        $translateClick->click();
        
        $selectFile = $this->driver->findElement(WebDriverBy::xpath("//*[@id='node_2']/div/div[4]/a"));
        $selectFile->click();
        
        $keyboard->pressKey(WebDriverKeys::ALT);
        $keyboard->pressKey("c");
        //sleep(2);
        $keyboard->releaseKey("c");
        $keyboard->releaseKey(WebDriverKeys::ALT);
                
        $selectFile1 = $this->driver->findElement(WebDriverBy::xpath("//*[@id='source_phrase_container']/div"));
        $a = $selectFile1->getText();
        $selectFile2 = $this->driver->findElement(WebDriverBy::xpath("//*[@id='translation']"));
        $b = $selectFile2->getAttribute('value');
        $this->assertEquals($a, $b);
        
        $keyboard->pressKey(WebDriverKeys::CONTROL);
        $keyboard->pressKey(WebDriverKeys::ENTER);
        sleep(2);
        $keyboard->releaseKey(WebDriverKeys::CONTROL);
        $keyboard->releaseKey(WebDriverKeys::ENTER);
        
        
        $selectFile3 = $this->driver->findElement(WebDriverBy::xpath("//*[@id='source_phrase_container']/div"));
        $c = $selectFile3->getText();
        $this->assertNotEquals($a, $c);
        
        $this->driver->wait()->until(WebDriverExpectedCondition::titleIs("crowdin_sample_android.xml - EditorShortCartTest - Crowdin translation"));
    }
   
}
