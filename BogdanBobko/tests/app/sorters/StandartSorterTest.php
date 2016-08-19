<?php

namespace CSR\Tests\App\Sorters;

use CSR\App\Sorters\StandartSorter;
use PHPUnit_Framework_TestCase;
use ReflectionMethod;

class StandartSorterTest extends PHPUnit_Framework_TestCase {
	private $inputArray = array(
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
	);

	private $outputArray = array(
		array(100, 99, 98, 97, 96, 95, 94, 93, 92, 91),
		array(90, 89, 88, 87, 86, 85, 84, 83, 82, 81),
		array(80, 79, 78, 77, 76, 75, 74, 73, 72, 71),
		array(70, 69, 68, 67, 66, 65, 64, 63, 62, 61),
		array(60, 59, 58, 57, 56, 55, 54, 53, 52, 51),
		array(50, 49, 48, 47, 46, 45, 44, 43, 42, 41),
		array(40, 39, 38, 37, 36, 35, 34, 33, 32, 31),
		array(30, 29, 28, 27, 26, 25, 24, 23, 22, 21),
		array(20, 19, 18, 17, 16, 15, 14, 13, 12, 11),
		array(10, 9, 8, 7, 6, 5, 4, 3, 2, 1),
	);

	public function testStraightSortLogic() {
		$sorter = new StandartSorter(true);
		$sorter->setArray($this->inputArray);
		$sorter->sort();

		$this->assertAttributeEquals($this->outputArray, 'sortedArray', $sorter);
	}

	public function testReverseSortLogic() {
		$sorter = new StandartSorter();
		$sorter->setArray($this->inputArray);
		$sorter->sort();

		$this->assertAttributeEquals($this->inputArray, 'sortedArray', $sorter);
	}

	// testing protected attribute
	public function testSort() {
		$outputArray = $this->inputArray;

		$sorter = new StandartSorter();
		$sorter->setArray($this->inputArray);
		$sorter->sort();

		$this->assertAttributeEquals($outputArray, 'sortedArray', $sorter);
	}

	// testing private method and private attribute
	public function testReverseSort() {
		$sorter = new StandartSorter(true);
		$sorter->setArray($this->inputArray);

		$reverseSortMethod = new ReflectionMethod(
			$sorter, 'reverseSort'
		);

		$reverseSortMethod->setAccessible(true);
		$reverseSortMethod->invoke($sorter);

		$this->assertAttributeEquals($this->outputArray, 'sortedArray', $sorter);
	}
}
