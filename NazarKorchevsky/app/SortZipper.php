<?php

    namespace sa\app;
    
    use sa\app\ArraySort;

    class SortZipper extends ArraySort
    {        
        public function sortArrayType($sort)
        {
            $array=$this->sortArray($sort);           
            self::$sort_type1 = 'Zipper  ' . $sort;
            
            if ($sort == 'ASC') {
                $f=1; 
            } elseif ($sort == 'DESC') {
                $f=2; 
            }
            
            foreach ($array as $key => $value) {
                if (is_array($value)) {                    
                    $tmp=$array[$key]; 
                    if (($f % 2) == 0)
                    {
                        $array[$key] = array_reverse($tmp);
                    }
                    $f++;
                }
            }
            return  $array;
        }
    }
