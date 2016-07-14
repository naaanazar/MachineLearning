<?php

    namespace sa\app\sorters;
    
    use sa\app\sorters\BaseSort;

    class VerticalSort extends BaseSort
    {        
        public function sortArrayType($sort)
        {
            $array=$this->sortArray($sort, $this->array);    
            self::$sort_type1 = 'Vertical  ' . $sort;
            array_unshift($array, null);
            $array = call_user_func_array('array_map', $array);
            return $array;
        }
        
        static public function addToFactoryArray()
        {
            return 'true';
        }
    }