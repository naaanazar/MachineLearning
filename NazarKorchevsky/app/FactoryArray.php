<?php 

    namespace sa\app;

    class FactoryArray 
    {    
        public static function sort($type)

        {         
           $className = 'sa\app\sorters\\'.$type;
          //  $className = 'sa\app\sorters\HorizontalSort';
            return new $className;    
        }

    }
