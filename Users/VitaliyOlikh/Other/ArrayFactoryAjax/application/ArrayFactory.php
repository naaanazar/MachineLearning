<?php
namespace project\application;

class ArrayFactory
{
    const TYPE_STANDART = 'standart';
    const TYPE_SNAKE = 'snake';
    const TYPE_SPIRAL = 'spiral';
    const TYPE_SPIRALREV = 'spiral reverse';
    const TYPE_VERTICAL = 'vertical';
    const TYPE_VERTICALREV = 'vertical reverse';

    private static $types = array(
        self::TYPE_STANDART,
        self::TYPE_SNAKE,
        self::TYPE_SPIRAL,
        self::TYPE_SPIRALREV,
        self::TYPE_VERTICAL,
        self::TYPE_VERTICALREV,
    );

    public static function getSorter($type)
    {
        if (!in_array($type, self::getAllType())) {
            throw new \Exception('Type not falid!');
        }

        switch ($type) {
            case self::TYPE_STANDART:
                return new ArraySorts\StandartSorter();
            case self::TYPE_SNAKE:
                return new ArraySorts\SnakeSorter();
            case self::TYPE_SPIRAL:
                return new ArraySorts\SpiralSorter();
            case self::TYPE_SPIRALREV:
                return new ArraySorts\SpiralRevSorter();
            case self::TYPE_VERTICAL:
                return new ArraySorts\VerticalSorter();
            case self::TYPE_VERTICALREV:
                return new ArraySorts\VerticalRevSorter();
        }
    }

    public static function getAllType()
    {
        return self::$types;
    }
}
