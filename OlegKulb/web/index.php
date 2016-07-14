<?php

require '__DIR___' . '/../../vendor/autoload.php';

use ex\app\FactorySort;

/**
 * @param string $method Names sort of array(snake, spiral, diagonal, vertically)
 * @param int $size Array size
 */

FactorySort::factorySort('snake', 4);
