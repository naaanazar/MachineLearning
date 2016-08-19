<?php

use app\Sorter\DiagonalSort;
use app\Figure\Matrix;

class DiagonalSortTest extends PHPUnit_Framework_TestCase {

    /**
     * 
     * @dataProvider sizesProvider
     */
    public function testSort($size) {

        $testMatrix = new Matrix($size);
        $testArray = $testMatrix->getArray();

        $initialArray = $testArray;

        $diagonalSorter = new DiagonalSort();

        $testMatrix->setArray($diagonalSorter->sort($testArray));

        $this->assertSame($testMatrix->diff($testArray, $initialArray), $testMatrix->diff($initialArray, $testArray));
    }

    public static function sizesProvider() {

        return array(
            array(1),
            array(5),
            array(10),
            array(15),
        );
    }

}
