<?php

namespace tests;

use Laracasts\Integrated\Extensions\Selenium as IntegrationTest;

abstract class AbstractSeleniumTest extends IntegrationTest {

    protected function findByCssSelector($selector)
    {
        try {
            return $this->session->element('css selector', $selector);
        } catch (NoSuchElement $e) {
            throw new InvalidArgumentException(
                "Couldn't find an element, matching the following css selector: '{$selector}'."
            );
        }
    }

    public function clickCss($selector)
    {
        $this->findByCssSelector($selector)->click();

        return $this;
    }

}