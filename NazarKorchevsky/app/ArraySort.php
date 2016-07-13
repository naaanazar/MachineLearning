<?php    

    namespace sa\app;   
    

    abstract class ArraySort 
    {              
        public $array;
        public $sort = 'ASC';
        public $sort_type; 
        static public $sort_type1; 

        function __construct($array)
        {
            $this->array = $array;                 
        }

        abstract public function sortArrayType($sort);
        
        public function sortArray($sort)
        {            
            global $ar;
            global $n;
            
            $ar = [];
            $n = max( array_map( 'count',  $this->array ) );
            //$this->sort_type = 'Sort  ' . $sort;
            
            foreach ($this->array as $j => $value) {
                $ar= array_merge($ar, $value);                
            } 
            
            if ($sort == 'DESC') {
                rsort($ar);
            } elseif($sort == 'ASC') {
                sort($ar);
            }
            
            $sort_array=array_chunk($ar, $n);
            return $sort_array;            
        }
    }