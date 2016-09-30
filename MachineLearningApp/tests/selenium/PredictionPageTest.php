<?php

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverSelect;

class PredictionPageTest extends \PHPUnit_Framework_TestCase
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
    public function testGeneratorPage ($host, $desiredCapabilities)
    {
        $this->driver = RemoteWebDriver::create($host, $desiredCapabilities);
        $this->driver->get('http://laravel:3080/prediction');

        $this->driver->wait()->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id('country')));

        $selectDataSourceId = new WebDriverSelect($this->driver->findElement(WebDriverBy::id("ml_model_id")));
        sleep(2);
        $selectDataSourceId->selectByValue('57ed070f67ec2');


        $email = $this->driver->findElement(WebDriverBy::id('email'));
        $email->sendKeys(1);

        $sameEmail = $this->driver->findElement(WebDriverBy::id('same-email'));
        $sameEmail->sendKeys(10);

        $projectsCount = $this->driver->findElement(WebDriverBy::id('projects-count'));
        $projectsCount->sendKeys(100);

        $stringCount = $this->driver->findElement(WebDriverBy::id('string-count'));
        $stringCount->sendKeys(10000);

        $membersCount = $this->driver->findElement(WebDriverBy::id('members-count'));
        $membersCount->sendKeys(50);

        $hasPrivatProject = $this->driver->findElement(WebDriverBy::id('has-privat-project'));
        $hasPrivatProject->sendKeys(1);

        $sameLogProject = $this->driver->findElement(WebDriverBy::id('same-log-project'));
        $sameLogProject->sendKeys(0);

        $lastLogin = $this->driver->findElement(WebDriverBy::id('last-login'));
        $lastLogin->sendKeys(10);

        $country = $this->driver->findElement(WebDriverBy::id('country'));
        $country->sendKeys('Ukraine');

        $send = $this->driver->findElement(WebDriverBy::xpath("//*[starts-with(attribute::value, 'Send')]"));
        $send->click();

        $this->driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::xpath("//*[contains(text(),'Predicted Scores:')]")));
        $this->driver->findElement(WebDriverBy::xpath("//*[contains(text(),'Predicted Scores:')]"))->isDisplayed();
    }
}
