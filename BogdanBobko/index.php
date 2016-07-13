<?php

ini_set('display_errors', 1);

require_once 'App/ArraySorterFactory.class.php';
require_once 'App/Generators/ArrayGenerator.class.php';

$sorterFactory = new App\ArraySorterFactory();
$generatedArray = \App\Generators\StandartArrayGenerator::generate();

//foreach($sorterFactory::getAllTypes() as $type) {
foreach(array(\App\ArraySorterFactory::TYPE_STANDART, \App\ArraySorterFactory::TYPE_VERTICAL) as $type) {
	$sorter = $sorterFactory->getSorter($type);

	$sorter->displayTitle();
	$sorter->setArray($generatedArray);

	$sorter->sort();
	$sorter->display();
}
