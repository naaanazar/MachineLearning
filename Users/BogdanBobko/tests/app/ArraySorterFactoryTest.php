<?php

namespace CSR\Tests\App;

use CSR\App\ArraySorterFactory;
use PHPUnit_Framework_TestCase;

class ArraySorterFactoryTest extends PHPUnit_Framework_TestCase {
	private function getNSClassName($className)
	{
		return '\CSR\App\Sorters\\' . $className;
	}

	public function sortersDataProvider()
	{
		return array(
            ArraySorterFactory::TYPE_DIAGONAL => array(
				ArraySorterFactory::TYPE_DIAGONAL, $this->getNSClassName('DiagonalSorter')
			),
            ArraySorterFactory::TYPE_REV_DIAGONAL => array(
				ArraySorterFactory::TYPE_REV_DIAGONAL, $this->getNSClassName('DiagonalSorter')
			),
            ArraySorterFactory::TYPE_SNAKE => array(
				ArraySorterFactory::TYPE_SNAKE, $this->getNSClassName('SnakeSorter')
			),
            ArraySorterFactory::TYPE_SPIRAL => array(
				ArraySorterFactory::TYPE_SPIRAL, $this->getNSClassName('SpiralSorter')
			),
            ArraySorterFactory::TYPE_REV_SPIRAL => array(
				ArraySorterFactory::TYPE_REV_SPIRAL, $this->getNSClassName('SpiralSorter')
			),
        );
    }

	/**
     * @expectedException     Exception
     * @expectedExceptionMessage     Unsupported type
     */
	public function testGetSorterException()
	{
		ArraySorterFactory::getSorter('');
	}

    /**
     * @dataProvider sortersDataProvider
     */
    public function testGetSorter($type, $expected)
    {
        $result = ArraySorterFactory::getSorter($type);
        $this->assertInstanceOf($expected, $result);
    }
}
