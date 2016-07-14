<?php

    namespace sa\app;
    
    use sa\app\ArraySort;

    class SortHorizontal extends ArraySort
    {        
        public function sortArrayType($sort)
        {
            $array=$this->sortArray($sort);   
            self::$sort_type1 = 'Horizontal  ' . $sort;
            return $array;
        }
    }