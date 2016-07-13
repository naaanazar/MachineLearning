<?php
namespace yu\app;

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
		self::TYPE_REV_DIAGONAL,
		self::TYPE_SNAKE,
   );     
    
   public static function getSorter($type)
   {
       echo"1";
   }
}


