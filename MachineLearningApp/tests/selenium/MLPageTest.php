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
    public function testCreateMLModel ($host, $desiredCapabilities)
    {
        $this->driver = RemoteWebDriver::create($host, $desiredCapabilities);
        $this->driver->get('http://laravel:3080/ml');

        $buttonCreateMLMode = WebDriverBy::xpath("//*[@id='ml-button-create']/button");
        $inputAreaMLModelName = WebDriverBy::id('MLModelName');

        $openAdvancedSettings = $this->driver->findElement(WebDriverBy::xpath("//*[contains(text(),'Advanced settings')]"));
        $openAdvancedSettings->click();

        $this->driver->wait()->until(WebDriverExpectedCondition::elementToBeClickable($buttonCreateMLMode));
        $this->assertEquals('http://laravel:3080/ml#describeMLModels', $this->driver->getCurrentURL());

        $createDatasource = $this->driver->findElement($buttonCreateMLMode);
        $createDatasource->click();

        $this->driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated($inputAreaMLModelName));
        $inputMLModelName = $this->driver->findElement($inputAreaMLModelName);
        $inputMLModelName->clear();
        $inputMLModelName->sendKeys('selenium-test');

        $selectDataSourceId = new WebDriverSelect($this->driver->findElement(WebDriverBy::id('SelectDataSource')));
        sleep(1);
        $selectDataSourceId->selectByValue('157ed3c3201fb3');

        $submit = $this->driver->findElement(WebDriverBy::id('success-button-modal-ml'));
        $submit->click();

        $this->driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath("//*[contains(text(),'Successfully created:')]")));

        $this->driver->navigate()->refresh();

        $this->driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath("//*[contains(text(),'ml: selenium-test')]")));

        $a = $this->driver->findElement(WebDriverBy::xpath("//*[contains(text(),'ml: selenium-test')]"))->getText();
        $b = 'ml: selenium-test';
        $this->assertEquals($a, $b);

        $openInfo = $this->driver->findElement(WebDriverBy::xpath("//*[contains(text(),'ml: selenium-test')]//..//a[2]"));
        $openInfo->click();

        $this->driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath("//*[@id='modal']//button")));
        $this->driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath("//*[contains(text(),'Model  Id')]")));
        
        $a1 = $this->driver->findElement(WebDriverBy::xpath("//*[contains(text(),'Model  Id')]"))->getText();
        $b1 = 'Model Id';
        $this->assertEquals($a1, $b1);

        $closeInfo = $this->driver->findElement(WebDriverBy::xpath("//*[@id='modal']//button"));
        $closeInfo->click();

        $this->driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath("//*[contains(text(),'ml: selenium-test')]")));
        sleep(1);
        
        $deleteMLMode = $this->driver->findElement(WebDriverBy::xpath("//*[contains(text(),'ml: selenium-test')]//..//a[3]"));
        $deleteMLMode->click();

        $this->driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath("//*[contains(text(),'Successfully removed: ml: selenium-test')]")));
    }

    /**
     * @dataProvider addDataProvider
     */
    public function testCreateEvaluation ($host, $desiredCapabilities)
    {
        $this->driver = RemoteWebDriver::create($host, $desiredCapabilities);
        $this->driver->get('http://laravel:3080/ml#describeEvaluations');

        $buttonCreateMLMode = WebDriverBy::xpath("//*[@id='ml-button-create']/button");
        $inputAreaEvaluationName = WebDriverBy::id('EvaluationName');

        $this->driver->wait()->until(WebDriverExpectedCondition::elementToBeClickable($buttonCreateMLMode));
        $createDatasource = $this->driver->findElement($buttonCreateMLMode);
        $createDatasource->click();

        $this->driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated($inputAreaEvaluationName));
        $inputMLModelName = $this->driver->findElement($inputAreaEvaluationName);
        $inputMLModelName->clear();
        $inputMLModelName->sendKeys('selenium-test');

        $selectModelName = new WebDriverSelect($this->driver->findElement(WebDriverBy::id('SelectMLModelId')));
        sleep(1);
        $selectModelName->selectByValue('57ed070f67ec2');

        $selectDatasourceName = new WebDriverSelect($this->driver->findElement(WebDriverBy::id('SelectEvDataSource')));
        sleep(1);
        $selectDatasourceName->selectByValue('157ed05c686f6b');

        $submit = $this->driver->findElement(WebDriverBy::id('success-button-modal-ev'));
        $submit->click();

        $this->driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath("//*[contains(text(),'Successfully created:')]")));

        $this->driver->navigate()->refresh();

        $this->driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath("//*[contains(text(),'ev: selenium-test')]")));

        $a = $this->driver->findElement(WebDriverBy::xpath("//*[contains(text(),'ev: selenium-test')]"))->getText();
        $b = 'ev: selenium-test';
        $this->assertEquals($a, $b);

        $openInfo = $this->driver->findElement(WebDriverBy::xpath("//*[contains(text(),'ev: selenium-test')]//..//a[1]"));
        $openInfo->click();

        $this->driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath("//*[@id='modal']//button")));
        $this->driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath("//*[contains(text(),'Model  Id')]")));

        $a1 = $this->driver->findElement(WebDriverBy::xpath("//*[contains(text(),'Model  Id')]"))->getText();
        $b1 = 'Model Id';
        $this->assertEquals($a1, $b1);

        $closeInfo = $this->driver->findElement(WebDriverBy::xpath("//*[@id='modal']//button"));
        $closeInfo->click();

        $this->driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath("//*[contains(text(),'ev: selenium-test')]")));
        sleep(1);

        $deleteEvaluations = $this->driver->findElement(WebDriverBy::xpath("//*[contains(text(),'ev: selenium-test')]//..//a[2]"));
        $deleteEvaluations->click();

        $this->driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath("//*[contains(text(),'Successfully removed: ev: selenium-test')]")));
    }
}