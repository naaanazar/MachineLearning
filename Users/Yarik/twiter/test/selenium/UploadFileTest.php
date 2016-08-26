<?php

namespace Projarr\Test\Selenium;

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverKeys;
use Facebook\WebDriver\Remote\LocalFileDetector;

class UploadFileTest extends \PHPUnit_Framework_TestCase {
    
    protected $driver;

    public function testUploadFile()
    {
//        $this->driver = RemoteWebDriver::create('http://192.168.1.156:9515', DesiredCapabilities::chrome());
        $this->driver = RemoteWebDriver::create('http://192.168.0.105:9515', DesiredCapabilities::chrome());
        $this->driver->manage()->window()->maximize(); //відкриває сторінку на повний екран
        $this->driver->get('https://davidwalsh.name/demo/multiple-file-upload.php');

      //  $selectLeng = $this->driver->findElement(WebDriverBy::id("filesToUpload"));
      //  $selectLeng->click();

        $file_input = $this->driver->findElement(WebDriverBy::id('filesToUpload'));
        $file_input->setFileDetector(new LocalFileDetector());
        $file_input->sendKeys('/media/Crowdin/Service/www/arr/image/images.jpg');

        //$this->driver->wait()->until(WebDriverExpectedCondition::alertIsPresent()); //очікує на вікно alert

        //sleep(1);
    }
}
