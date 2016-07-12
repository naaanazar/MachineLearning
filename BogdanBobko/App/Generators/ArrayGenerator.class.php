<?php

namespace App\Generators;

require_once 'BaseGenerator.interface.php';

class StandartArrayGenerator implements BaseArrayGenerator {
	public static function generate()
	{
		return range(1, 100);
	}
}
