<?php

namespace arr\app;

use Exception;

/**
 * Description of ArraysFactory
 *
 * @author Nazar
 */
class ArraysFactory
{
    private static $sortTypes = array(
        "SnakeSort",
        "StraightSort",
        "VerticalSort"
    );

    public function getSorter($sortType)
    {
        $className = ucfirst($sortType);
        if (!in_array($className, self::$sortTypes)) {
            throw new Exception('Type doesn\'t exists!');
        }        
        $objectName = "arr\app\sorters\\" . $className;
        return new $objectName();
    }
}
