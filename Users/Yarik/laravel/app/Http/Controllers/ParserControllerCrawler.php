<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Yarik\ParserCrawler;

class ParserControllerCrawler extends Controller
{
   public function index()
   {
       $parser = new ParserCrawler();
       $html = $parser->fetchPage('http://comfy.ua/telephone/');
       print_r($html);
       die();
   }
}
