<?php

namespace CSR\App\Generators;

use CSR\App\Generators\BaseArrayGenerator;

// Generates standart single-dimension array
class StandartArrayGenerator implements BaseArrayGenerator {
	public static function generate()
	{
		return range(1, 100);
	}
}
