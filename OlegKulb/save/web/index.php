<?php

require '__DIR___' . '/../../vendor/autoload.php';

use ex\app\FactorySort;

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

/**
 * @param string $method Names sort of  array(snake, spiral, diagonal, vertically)
 * @param int $size Array size
 * @param string $file File name ('file.txt')
 */

FactorySort::factorySort('snake', rand(1, 15));