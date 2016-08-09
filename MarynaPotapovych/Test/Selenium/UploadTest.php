<?php


namespace liw\Test\Selenium;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverKeys;
use Facebook\WebDriver\Remote\LocalFileDetector;


class UploadTest extends \PHPUnit_Framework_TestCase
{
    protected $driver;

    public function setUp()
    {
        $host = 'http://192.168.1.153:9515';
        $this->driver = RemoteWebDriver::create($host, DesiredCapabilities::chrome());
        $this->driver->manage()->window()->maximize();

    }

    public function tearDown()
    {
        $this->driver->quit();
    }
    
    public function testActionUpload()
    {
        $this->driver->get('https://davidwalsh.name/demo/multiple-file-upload.php');
        $file_input = $this->driver->findElement(WebDriverBy::xpath("//*[@id='filesToUpload']"));


         $file_input->setFileDetector(new LocalFileDetector());


        $file_input->sendKeys('E:\Crowdin\Service\MarynaPotapovych\ClassArr.php');
    }
     
}    
