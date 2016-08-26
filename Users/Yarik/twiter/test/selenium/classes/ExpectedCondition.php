<?php

namespace Projarr\Test\Selenium\Classes;

use Facebook\WebDriver\WebDriverExpectedCondition;

class ExpectedCondition extends WebDriverExpectedCondition {

    public static function pageIsReady()
    {
        return new ExpectedCondition(
                function ($driver) {
                    $status = $driver->executeScript("return document.readyState");
                    return $status === "complete" ? true : false;
                }
        );
    }

    public static function allXhrFinnished()
    {
        return new ExpectedCondition(
            function ($driver) {
                return $driver->executeScript("return $.active == 0");
            }
        );
    }
    
    public static function urlIs($url)
    {
        return new ExpectedCondition(
            function ($driver) use ($url) {
                return $driver->getCurrentUrl() === $url;
            }
        );
    }
}