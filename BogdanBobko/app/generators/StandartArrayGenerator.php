<?php

namespace CSR\App\Generators;

use CSR\App\Generators\ArrayGeneratorInterface;

class StandartArrayGenerator implements ArrayGeneratorInterface {
	private static $dimensions = array(
		'columns' => 10,
		'rows' => 10
	);

	public static function generate()
	{
		$array = array();
		$counter = 0;

		for ($rowIndex = 0; $rowIndex < self::$dimensions['rows']; $rowIndex++) {
			for ($itemIndex = 0; $itemIndex < self::$dimensions['columns']; $itemIndex++) {
				$array[$rowIndex][$itemIndex] = ++$counter;
			}
		}

		return $array;
	}
}
