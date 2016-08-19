<?php

namespace liw\Test\Selenium;

require_once('vendor/autoload.php');
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\Remote\DesiredCapabilities;


class CrossTest extends \PHPUnit_Framework_TestCase

{
protected $web_driver;
public function testCross ()
        {
$web_driver = RemoteWebDriver::create(
    "https://marynapotapovych1:EabcU3mBifyzFozqC51K@hub-cloud.browserstack.com/wd/hub",
    array("platform"=>"WINDOWS", "browserName"=>"firefox")
  );
  $web_driver->get("http://google.com");

  $element = $web_driver->findElement(WebDriverBy::name("q"));
  if($element) {
      $element->sendKeys("Browserstack");
      $element->submit();
  }

  print $web_driver->getTitle();
  $web_driver->quit();
}
}
