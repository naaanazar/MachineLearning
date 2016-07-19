<?php

ini_set('display_errors', 1);

require_once __DIR__ . '/../init.php';
require_once __DIR__ . '/../vendor/autoload.php';

use CSR\App\Sorters\ArraySorterFactory;
use CSR\App\Generators\StandartArrayGenerator;

$sorterFactory = new ArraySorterFactory();
$generatedArray = StandartArrayGenerator::generate();

foreach ($sorterFactory::getAllTypes() as $type) {
	$sorter = $sorterFactory->getSorter($type);

	$sorter->displayTitle();
	$sorter->setArray($generatedArray);

	$sorter->sort();
	$sorter->display();
}
