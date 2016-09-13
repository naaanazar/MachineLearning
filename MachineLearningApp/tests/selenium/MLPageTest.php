<?php

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverSelect;

class MLPageTest extends \PHPUnit_Framework_TestCase
{

    protected $driver;

    public function addDataProvider()
    {
        return array (
            array ('http://192.168.2.134:9515', DesiredCapabilities::chrome()),
            array ('http://192.168.2.134:4444/wd/hub', DesiredCapabilities::firefox())
//            array ('http://192.168.0.101:4444/wd/hub', DesiredCapabilities::firefox()),
//            array ('http://192.168.0.101:9515', DesiredCapabilities::chrome()),
        );
    }

    public function tearDown()
    {
        $this->driver->quit();
    }

    /**
     * @dataProvider addDataProvider
     */
    public function testOpenPredictionsPage ($host, $desiredCapabilities)
    {
        $this->driver = RemoteWebDriver::create($host, $desiredCapabilities);
        $this->driver->get('http://laravel:3080/ml');

        $insetMLModels = WebDriverBy::id('describeMLModelsContent');
        $buttonCreateMLMode = WebDriverBy::xpath("//*[@id='ml-button-create']/button");
        $inputAreaMLModelName = WebDriverBy::id('MLModelName');
        $dropdownmenuMLmodeltype = WebDriverBy::id('MLModelType');
        $dropdownmenuDataSourceId = WebDriverBy::id('SelectDataSource');
        $buttonSubmit = WebDriverBy::xpath("//*[@id='describeMLModels']//button");

        $this->driver->wait()->until(WebDriverExpectedCondition::elementToBeClickable($insetMLModels));
        $MLModels = $this->driver->findElement($insetMLModels);
        $MLModels->click();

        $this->driver->wait()->until(WebDriverExpectedCondition::elementToBeClickable($buttonCreateMLMode));
        $createDatasource = $this->driver->findElement($buttonCreateMLMode);
        $createDatasource->click();

        $this->driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated($inputAreaMLModelName));
        $inputMLModelName = $this->driver->findElement($inputAreaMLModelName);
        $inputMLModelName->clear();
        $inputMLModelName->sendKeys('selenium-test');

        $selectMLmodeltype = new WebDriverSelect($this->driver->findElement($dropdownmenuMLmodeltype));
        $selectMLmodeltype->selectByValue('BINARY');

        $selectDataSourceId = new WebDriverSelect($this->driver->findElement($dropdownmenuDataSourceId));
        sleep(1);
        $selectDataSourceId->selectByValue('d-57d7f4d9a323a');

        $submit = $this->driver->findElement($buttonSubmit);
        $submit->click();

        sleep(2);

        $this->driver->wait()->until(WebDriverExpectedCondition::elementToBeClickable($insetMLModels));
        $MLModels1 = $this->driver->findElement($insetMLModels);
        $MLModels1->click();

        sleep(1);

        $a = $this->driver->findElement(WebDriverBy::xpath("//*[contains(text(),'selenium-test')]"))->getText();
        $b = 'selenium-test';
        $this->assertEquals($a, $b);

        $deleteMLMode = $this->driver->findElement(WebDriverBy::xpath("//*[contains(text(),'selenium-test')]//..//a[2]"));
        $deleteMLMode->click();
        sleep(2);
    }
}