<?php

namespace arr\app;

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
            echo "Type doesn't exist!";
            return;
        }        
        $objectName = "arr\app\sorters\\" . $className;
        return new $objectName();
    }
}
