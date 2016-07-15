<?php

namespace sa\app;

class FactoryArray
{

    public static function getClass($class)
    {
        $className = 'sa\app\sorters\\' . $class;

        return new $className;
    }
}
