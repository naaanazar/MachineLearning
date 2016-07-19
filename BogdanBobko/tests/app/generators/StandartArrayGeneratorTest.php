<?php

namespace CSR\Tests\App\Generators;

use CSR\App\Generators\StandartArrayGenerator;
use PHPUnit_Framework_TestCase;

class StandartArrayGeneratorTest extends PHPUnit_Framework_TestCase {
	public function testGenerate()
	{
        $this->assertEquals(array(
			array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10),
			array(11, 12, 13, 14, 15, 16, 17, 18, 19, 20),
			array(21, 22, 23, 24, 25, 26, 27, 28, 29, 30),
			array(31, 32, 33, 34, 35, 36, 37, 38, 39, 40),
			array(41, 42, 43, 44, 45, 46, 47, 48, 49, 50),
			array(51, 52, 53, 54, 55, 56, 57, 58, 59, 60),
			array(61, 62, 63, 64, 65, 66, 67, 68, 69, 70),
			array(71, 72, 73, 74, 75, 76, 77, 78, 79, 80),
			array(81, 82, 83, 84, 85, 86, 87, 88, 89, 90),
			array(91, 92, 93, 94, 95, 96, 97, 98, 99, 100),
		), StandartArrayGenerator::generate());
	}
}
