<?php

use app\Figure\Matrix;

class MatrixTest  extends PHPUnit_Framework_TestCase {
    
 public function testDefaultSize() {

$obj = new Matrix();

$this->assertEquals(5, count( $obj->getArray() ));

}

/** 
    * @dataProvider arraySizeProvider
    */

public function testCustomSize($size) {

$obj = new Matrix($size);

$this->assertEquals($size, count( $obj->getArray() ));

}



    

public function arraySizeProvider(){
    
    $testSizes = array();
    
    for($i = 0; $i<10; $i++){
        $testSizes[] = array($i);
    }
    
    return $testSizes;
}
   
    
}
