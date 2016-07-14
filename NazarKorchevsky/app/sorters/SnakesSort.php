<?php

    namespace sa\app\sorters;
    
    use sa\app\sorters\BaseSort;

    class SnakesSort extends BaseSort
    {        
        public function sortArrayType($sort)
        {
            $array=$this->sortArray($sort, $this->array);          
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
        
        static public function addToFactoryArray()
        {
            return 'true';
        }
    }
