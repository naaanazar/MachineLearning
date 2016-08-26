<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Andrew\parser;

class ParserController extends Controller
{
	public $URL = 'http://rozetka.com.ua/krepkie-napitki/c4594292/filter/vid-napitka-69821=whiskey-blend%2Cwhiskey-bourbon%2Cwhiskey-single-malt/';
	
    public function index()
    {
    	$parse = new Parser;
    	$parse->curl($this->URL);
    	$parse->createDOM();
    	$parse->createLinkList();
    	$parse->getContent();
    }
}
