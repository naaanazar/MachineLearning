<?php    

    namespace sa\app\sorters;   
    
    use sa\app\NewArray;
    
    abstract class BaseSort 
    {              
        public $array;
        public $sort = 'ASC';
        public $sort_type; 
        static public $sort_type1; 

       function __construct()
        {
            $this->array = NewArray::$array;                 
        }

        abstract public function sortArrayType($sort);
        abstract static public function addToFactoryArray();
        
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