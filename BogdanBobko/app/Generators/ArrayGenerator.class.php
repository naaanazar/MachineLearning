<?php

namespace App\Generators;

require_once 'BaseGenerator.interface.php';

// Generates standart single-dimension array
class StandartArrayGenerator implements BaseArrayGenerator {
	public static function generate()
	{
		return range(1, 100);
	}
}
