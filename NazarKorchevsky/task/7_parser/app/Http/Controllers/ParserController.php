<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Nazar\Parser;

class ParserController extends Controller
{

    public function parse()
    {
   $parser = new Parser;   
  $parser->curl('http://comfy.ua/plane-table-computer/');
  $parser->DOM();
  $parser->links();
  $parser->getData();


 //   return "sdfsdf111111sdfsdf";
    }
}
