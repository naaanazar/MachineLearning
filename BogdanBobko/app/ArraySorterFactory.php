<?php

namespace CSR\App;

use CSR\App\Sorters;

class ArraySorterFactory
{
	const TYPE_STANDART = 'standart';
	const TYPE_VERTICAL = 'vertical';
	const TYPE_REV_VERTICAL = 'reversed_vertical';
	const TYPE_SPIRAL = 'spiral';
	const TYPE_REV_SPIRAL = 'reversed_spiral';
	const TYPE_DIAGONAL = 'diagonal';
	const TYPE_REV_DIAGONAL = 'reversed_diagonal';
	const TYPE_SNAKE = 'snake';

	private static $types = array(
		self::TYPE_STANDART,
		self::TYPE_VERTICAL,
		self::TYPE_REV_VERTICAL,
		self::TYPE_SPIRAL,
		self::TYPE_REV_SPIRAL,
		self::TYPE_DIAGONAL,
		self::TYPE_SNAKE,
	);

	public static function getSorter($type)
	{
		if (!in_array($type, self::getAllTypes())) {
			throw new \Exception('Unsupported type');
		}

		switch ($type) {
			case self::TYPE_STANDART:
				return new Sorters\StandartSorter();
			case self::TYPE_VERTICAL:
				return new Sorters\VerticalSorter();
			case self::TYPE_REV_VERTICAL:
				return new Sorters\VerticalSorter(true);
			case self::TYPE_SPIRAL:
				return new Sorters\SpiralSorter();
			case self::TYPE_REV_SPIRAL:
				return new Sorters\SpiralSorter(true);
			case self::TYPE_DIAGONAL:
				return new Sorters\DiagonalSorter();
			case self::TYPE_REV_DIAGONAL:
				return new Sorters\DiagonalSorter(true);
			case self::TYPE_SNAKE:
				return new Sorters\SnakeSorter();
		}
	}

	public static function getAllTypes()
	{
		return self::$types;
	}
}
