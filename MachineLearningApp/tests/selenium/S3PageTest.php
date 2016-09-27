<?php

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverSelect;
use Facebook\WebDriver\Remote\LocalFileDetector;

class S3PageTest extends \PHPUnit_Framework_TestCase
{
    protected $driver;

    public function addDataProvider()
    {
        return array (
//            array ('http://192.168.2.134:9515', DesiredCapabilities::chrome()),
            array ('http://192.168.2.134:4444/wd/hub', DesiredCapabilities::firefox())
//            array ('http://192.168.0.101:4444/wd/hub', DesiredCapabilities::firefox()),
//            array ('http://192.168.0.101:9515', DesiredCapabilities::chrome()),
        );
    }

    public function tearDown()
    {
//        $this->driver->quit();
    }

    /**
     * @dataProvider addDataProvider
     */
    public function testS3Page ($host, $desiredCapabilities)
    {
        $this->driver = RemoteWebDriver::create($host, $desiredCapabilities);
        $this->driver->get('http://laravel:3080/s3');


        $addBucket = $this->driver->findElement(WebDriverBy::id('describeCreateBucketContent'));
        $addBucket->click();

//        $this->driver->findElement(WebDriverBy::id("nameBucket"))->isDisplayed();
        sleep(1);

        $nameBucket = $this->driver->findElement(WebDriverBy::id('nameBucket'));
        $nameBucket->sendKeys('ml-test-selenium');

        $create = $this->driver->findElement(WebDriverBy::xpath('//*[@id="modalCreateBucket"]//form/button'));
        $create->isEnabled();
        $create->click();

        $this->driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath("//*[contains(text(),'ml-test-selenium')]//..//label")));

        $uploadFile = $this->driver->findElement(WebDriverBy::xpath("//*[contains(text(),'ml-test-selenium')]//..//label"));

        $uploadFile->setFileDetector(new LocalFileDetector());
        $uploadFile->sendKeys('/home/yarik/Crowdin/Share/Git_Crowdin/space/MachineLearningApp/tests/dataTest/test-selenium.csv');

        $delete = $this->driver->findElement(WebDriverBy::xpath("//*[contains(text(),'ml-test-selenium')]//..//*[@id='delete-3']"));
        $delete->isEnabled();
        $delete->click();
    }
}
