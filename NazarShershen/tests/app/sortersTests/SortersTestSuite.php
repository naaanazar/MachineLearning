<?php

namespace arr\tests\app\sortersTest;

use PHPUnit_Framework_TestSuite;

use arr\tests\app\sortersTest\StraightSortTest;

//use PHPUnit_Framework;

/**
 * Description of SortersTestSuite
 *
 * @author Nazar
 */
class SortersTestSuite
{
    public static function suite()
    {       
        $suite = new PHPUnit_Framework_TestSuite('SortersSuite');
        $suite->addTestSuite('\arr\tests\app\sortersTests\StraightSortTest');
//        $suite->addTestSuite('VerticalSortTest');
//        $suite->addTestSuite('SnakeSortTest');
        return $suite;
    }
}
