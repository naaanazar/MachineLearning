<?php

    namespace sa\app\sorters;
    
    use sa\app\sorters\BaseSort;

    class HorizontalSort extends BaseSort
    {        
        public function sortArrayType($sort)
        {
            $array=$this->sortArray($sort, $this->array);   
            self::$sort_type1 = 'Horizontal  ' . $sort;
            return $array;
        }
       static public function addToFactoryArray()
        {
            return 'true';
        }
    }