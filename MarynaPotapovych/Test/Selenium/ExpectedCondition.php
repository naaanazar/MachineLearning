<?php
namespace liw\Test\Selenium;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverKeys;

class ExpectedCondition extends WebDriverExpectedCondition
{
    public static function pageIsReady() {
    return new ExpectedCondition(
            function ($driver) {
      $status = $driver->executeScript("return document.readyState");
      return $status === "complete" ? true : false;
    }
    );
  }
​
  public static function allXhrFinnished() {
    return new ExpectedCondition(
            function ($driver) {
      return $driver->executeScript("return $.active == 0");
    }
    );
  }
​
  public static function urlIs($url) {
    return new ExpectedCondition(
            function ($driver) use ($url) {
      return $driver->getCurrentUrl() === $url;
    }
    );
  }
}
