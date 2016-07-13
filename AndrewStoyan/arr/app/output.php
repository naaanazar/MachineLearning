<?php
	namespace app;
	/**
	* Take care about outputing things 
	*
	*/
	class OutPut 
	{
		
		public static function Vidstup($value)
		{
			echo str_repeat('<br>', $value);
		}

		public static function OutPuts($value)
		{
			if($value < 10) {
                echo $value.str_repeat('&nbsp;', 3);
            } else {
                echo $value.str_repeat('&nbsp;', 1);
            }
  		}

		public static function OutPutArray($array, $number)
		{
			for ($i = 0; $i < $number; $i++) { 
                $this->Vidstup(1);
                for ($j = 0; $j < $number; $j++) { 
                    $this->OutPuts($array[$i][$j]);
                }
            }
		}

		public static function Vert($array, $number)
		{
			for ($j = 0; $j < $number; $j++) { 
                $this->Vidstup(1);
                for ($i = 0; $i < $number; $i++) {  
                    $this->OutPuts($array[$i][$j]);
                }
            }
		}

		public static function VertRev($array, $number)
		{
			for ($j = $number - 1; $j >= 0; $j--) { 
                $this->Vidstup(1);
                for ($i = $number - 1; $i >= 0; $i--) { 
                    $this->OutPuts($array[$i][$j]);   
                }
            }
		}

		public static function Snake($array, $number)
		{
			for ($i = 0; $i < $number; $i++) { 
                $this->Vidstup(1);
                if ($i % 2 == 0){
                    for ($j = 0; $j < $number; $j++) {
                        $this->OutPuts($array[$i][$j]);
                    }
                } else { 
                    for ($j = $number - 1; $j >= 0; $j--) {  
                        $this->OutPuts($array[$i][$j]);
                    }                           
                }
            }
		}
	}