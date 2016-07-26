    <?php

use app\Sorter\ZetSort;
use app\Figure\Matrix;

class ZetSortTest extends PHPUnit_Framework_TestCase{
    
    
    
  
/**
 * 
 * @dataProvider sizesProvider
 */
        public function testSort($size) {
        
        $testMatrix = new Matrix($size);
        
        $martix = $this->getMockBuilder('app\Figure\Matrix')
                ->getMock();
        $array = array(
                    array(1,2,3),
                    array(3,5,6),
                    array(7,8,9),             
                );
        $martix->method('getArray')
                ->willReturn($this->returnValue( $array ) );
        


           
        
        
        $testArray = $testMatrix->getArray();
        
       $initialArray = $testArray;
        
        $zetSorter = new ZetSort();
        
        $testMatrix->setArray( $zetSorter->sort( $testArray ) );
        
        $this->assertSame($testMatrix->diff( $testArray, $initialArray),
                         $testMatrix->diff( $initialArray, $testArray));
     
        }
        
        public static function sizesProvider(){
            
            return array(
                array(1),
                array(5),
                array(10),
                array(15),
                
                
            );
        }
        
    
}
