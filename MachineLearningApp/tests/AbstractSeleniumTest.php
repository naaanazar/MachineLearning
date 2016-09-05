<?php

use Laracasts\Integrated\Extensions\Selenium as BucketTest;

abstract class AbstractSeleniumTest extends BucketTest
{

  protected function findByCssSelector($selector)
  {
      try {
          return $this->session->element('css selector', $selector);
      } catch (NoSuchElement $e) {
          throw new InvalidArgumentException(
              "Couldn't find an element, matching the follwing css selector: '{$selector}'."
          );
      }
  }

  public function clickCss($selector)
  {
    $this->findByCssSelector($selector)->click();

    return $this;
  }

}