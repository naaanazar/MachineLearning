<?php


class testingTest extends PHPUnit_Framework_TestCase{

  public function testFunctionReturnHelloWorld()
  {
      $testing = new yu\app\generators\testing();
      $expected = "Hello World";

      $this->assertEquals($expected, $testing ->render());
  }
}
