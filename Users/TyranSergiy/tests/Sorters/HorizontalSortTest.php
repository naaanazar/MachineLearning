<?php

use app\Sorter\HorizontalSort;
use app\Figure\Matrix;

class HorizontalSortTest extends PHPUnit_Framework_TestCase {

    /**
     * 
     * @dataProvider sizesProvider
     */
    public function testSort($size) {

        $reverseTestMatrix = new Matrix($size);
        $testMatrix = new Matrix($size);
        
        $testArray = $testMatrix->getArray();
        $reverseTestArray = $reverseTestMatrix->getArray();

        $initialArray = $testArray;

        $horizontalSorter = new HorizontalSort();
        
        $reverseTestMatrix->setArray( $horizontalSorter->sort( $reverseTestArray, 2 ));
        $testMatrix->setArray( $horizontalSorter->sort($testArray) );

        $this->assertSame($testMatrix->diff($testArray, $initialArray), $testMatrix->diff($initialArray, $testArray));
        $this->assertSame($testMatrix->diff($reverseTestArray, $initialArray), $testMatrix->diff($initialArray, $reverseTestArray));

       
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
