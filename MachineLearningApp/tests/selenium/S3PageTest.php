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
//            array ('http://192.168.0.101:9515', DesiredCapabilities::chrome()),
            array ('http://192.168.2.134:4444/wd/hub', DesiredCapabilities::firefox())
//            array ('http://192.168.0.101:4444/wd/hub', DesiredCapabilities::firefox())
        );
    }

    public function tearDown()
    {
        $this->driver->quit();
    }

    /**
     * @dataProvider addDataProvider
     */
    public function testS3PageCreateAndDeleteBuket ($host, $desiredCapabilities)
    {
        $this->driver = RemoteWebDriver::create($host, $desiredCapabilities);
        $this->driver->get('http://laravel:3080/s3');

        $addBucket = $this->driver->findElement(WebDriverBy::id('describeCreateBucketContent'));
        $addBucket->click();

        $this->driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::id('nameBucket')));
        $nameBucket = $this->driver->findElement(WebDriverBy::id('nameBucket'));
        $nameBucket->sendKeys('ml-test-selenium');

        $create = $this->driver->findElement(WebDriverBy::xpath('//*[@id="modalCreateBucket"]//form//button'));
        $create->isEnabled();
        $create->click();

        $this->driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath("//*[contains(text(),'ml-test-selenium')]//..//label")));

        $uploadFile = $this->driver->findElement(WebDriverBy::xpath("//*[contains(text(),'ml-test-selenium')]//..//*[starts-with(attribute::id, 's3-upload-file')]"));
        $this->driver->executeScript("arguments[0].setAttribute('style', 'dispaly : block;')", array($uploadFile));
        $uploadFile->setFileDetector(new LocalFileDetector());
        $uploadFile->sendKeys("/home/yarik/Crowdin/Share/Git_Crowdin/space/MachineLearningApp/tests/dataTest/test-selenium.csv");

        sleep(3);

        $this->driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath("//*[contains(text(),'ml-test-selenium')]//..//label")));
        $openBacket = $this->driver->findElement(WebDriverBy::xpath("//*[contains(text(),'ml-test-selenium')]"));
        $openBacket->click();

        $this->driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath("//*[contains(text(),'test-selenium.csv')]")));
        $this->assertEquals('http://laravel:3080/s3#ml-test-selenium', $this->driver->getCurrentURL());
        $this->driver->findElement(WebDriverBy::xpath("//*[contains(text(),'test-selenium.csv')]"))->isDisplayed();

        $this->driver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(WebDriverBy::id('s3://ml-test-selenium/test-selenium.csv')));
        $deleteFiles = $this->driver->findElement(WebDriverBy::id('s3://ml-test-selenium/test-selenium.csv'));
        $deleteFiles->click();

        $this->driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath("//*[contains(text(),'Successfully removed: s3://ml-test-selenium/test-selenium.csv')]")));

        $backpage = $this->driver->findElement(WebDriverBy::xpath('//tr[2]/td'));
        $backpage->click();

        $this->assertEquals('http://laravel:3080/s3', $this->driver->getCurrentURL());

        $this->driver->navigate()->refresh();
        $this->driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath("//*[contains(text(),'ml-test-selenium')]//..//label")));

        $delete = $this->driver->findElement(WebDriverBy::xpath("//*[contains(text(),'ml-test-selenium')]//..//*[starts-with(attribute::id, 'delete')]"));
        $delete->isEnabled();
        $delete->click();
    }
}