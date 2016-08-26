<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Yarik\Parser;

class ParserController extends Controller
{
   public function index()
   {
       $parser = new Parser();
       $html = $parser->fetchPage('http://comfy.ua/conditioner-split/');
       print_r($html);
       die();
   }
}