<?php

ini_set('display_errors', 1);

require_once __DIR__ . '/../init.php';
require_once __DIR__ . '/../vendor/autoload.php';

use CSR\App\Output\Console;
use CSR\App\Storage\DBStorage;
use CSR\App\Sorters\ArraySorterFactory;
use CSR\App\Generators\StandartArrayGenerator;

$storage = new DBStorage();
$consoleOutput = new Console();
$sorterFactory = new ArraySorterFactory();
$generatedArray = StandartArrayGenerator::generate();

foreach ($sorterFactory::getAllTypes() as $type) {
	$sorter = $sorterFactory->getSorter($type);
	$sorter->setArray($generatedArray);
	$sorter->sort();

	$storage->saveArray($type, $sorter->getTitle(), $sorter->getSortedArray());

	$consoleOutput->plainDisplay(PHP_EOL . $sorter->getTitle() . PHP_EOL);
	$consoleOutput->setArray($storage->getArray($type));
	$consoleOutput->arrayDisplay();
}
