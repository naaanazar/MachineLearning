<?php

namespace liw\app;

class TreeClass
{
   public $originalPath;

   public $displayTree = '';

   public function __construct($path)
   {
       $this->originalPath = $path;
   }

   public function buidTree($path = NULL)
   {

       if($path == NULL) {
           $path = $this->originalPath;
       }

       $this->displayTree .= "<li>". dirname($path) ."</li>";
       $this->displayTree .= "<ul>";

       if($dir = opendir($path)) {

           while ( ($item = readdir($dir) ) !== false ) {
               
               if(in_array($item, array('.', '..'))) {
                   continue;
               }

               $internalPath = $path.$item."/";
               if(is_dir($internalPath)) {
                   $this->displayTree .= "<li>" .$this->buidTree($internalPath). "</li>";
               }
               $this->displayTree .= "<li>$item</li>";

           }
           closedir($dir);

       }

       $this->displayTree .= "</ul>";
       
       return $this->displayTree;
   }

}
