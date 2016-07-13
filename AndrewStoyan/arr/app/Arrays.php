<?php
namespace app;
/**
* Initialize arrays and etc.
*
*/
class Arrays 
{
	public $array;
	public $counter = 1;

	public function ArrayInit($number)
	{
		$this->$array = array();

        for ($i = 0; $i < $number; $i++) { 
            $this->$array[$i] = array();
        }
	}

	public function ArrayFeel($number)
	{	
		$this->ArrayInit($number);

		for ($i = 0; $i < $number; $i++) { 
            for ($j = 0; $j < $number; $j++) { 
                $this->array[$i][$j] = $this->count;
                $this->count++;
            }
        }

        return $this->array;
	}

	public function SpiralFeel($number, $method)
	{	
		$this->ArrayInit($number);

		if ($method == 1) {
			$count1 = 1;
		} else {
			$count1 = $number * $number;
		}

        $i = $j = 0;
        $right = $number - 1;
        $left = 0;

        for ($n = 0; $n < $number * $number; ++$n) {
        	if ($method == 1) {
            	$this->$array[$i][$j] = $count1++;
            } else {
            	$this->$array[$i][$j] = $count1--;
            }

            if (($i == ($left + 1)) && ($j == $left)) { 
                $right--;
                $left++;
            } 

            if (($j == $right) && ($i < $right)) { 
                $i++;
                continue;
            } 
            
            if (($j < $right) && ($i == $left)) {
                $j++; 
                continue;
            } 

            if (($i == $right) && ($j > $left)) { 
                $j--;
                continue;
            } 

            if (($j == $left) && ($i > $left)) {
                $i--; 
                continue;
            } 
        }

		return $this->array;
	}

	public function DiagFeel($number)
	{	
		$this->ArrayInit($number);
		$x = 0; 
        $y = 0; 
        $count2 = 1;
        
        for ($i = 0; $i < $number; $i++) { 
            $x = 0;
            $y = $i;         
            while ($y >= 0) {
               	$this->$array[$x][$y] = $count2++;
                $x++;
                $y--;
            }
        }       
        for ($i = 1; $i < $number; $i++) { 
            $x = $i;
            $y = $number - 1;
                       
            while ($x <= $number - 1) {
                $this->$array[$x][$y] = $count2++;
                $x++;
                $y--;
            }
        }
        return $this->array;
    }
}