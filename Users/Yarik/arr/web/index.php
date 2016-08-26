<?php

use Projarr\App\FactoryArr;

require __DIR__ . '/../vendor/autoload.php';

$factory = new FactoryArr();
foreach ($factory->getTypes() as $type) {
    $sorter = $factory->getArray($type);
    $sorter->sortArr();
    $sorter->displayArray();
    echo '<br />';
}