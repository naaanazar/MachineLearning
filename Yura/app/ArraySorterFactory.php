<?php

namespace yu\app;

class ArraySorterFactory
{
	const TYPE_HORIZONTAL = 'horizontal';
	const TYPE_TRANSPOSE = 'transpose';
	const TYPE_INV_TRANSPOSE = 'inv_transpose';

	private static $types = array(
		self::TYPE_HORIZONTAL,
		self::TYPE_TRANSPOSE,
		self::TYPE_INV_TRANSPOSE
    );

    public static function getSorter($type)
    {
        if ($type === self::TYPE_HORIZONTAL) {
            return new \yu\app\sorters\ArrayHorizontal();
        } elseif ($type === self::TYPE_TRANSPOSE) {
            return new \yu\app\sorters\TransposeArray();
        } else {
            return new \yu\app\sorters\TransposeArrayInversion();
        }
    }

    public static function getAllTypes()
    {
        return array(
            self::TYPE_HORIZONTAL,
            self::TYPE_INV_TRANSPOSE,
            self::TYPE_TRANSPOSE
        );
    }
}
