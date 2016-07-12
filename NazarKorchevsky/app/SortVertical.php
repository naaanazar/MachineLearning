<?php

    namespace sa\app;
    
    use sa\app\ArraySort;

    class SortVertical extends ArraySort
    {
        
        public function sortArrayType($sort)
        {
            $array=$this->sortArray($sort);   
            self::$sort_type1 = 'Rotate array  ' . $sort;
            array_unshift($array, null);
            $array = call_user_func_array('array_map', $array);
            return $array;
        }
    }