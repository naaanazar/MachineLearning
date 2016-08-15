<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Andrew\crawlerParse;

class CrawlerController extends Controller
{
	public $URL = 'http://rozetka.com.ua/krepkie-napitki/c4594292/filter/vid-napitka-69821=whiskey-blend%2Cwhiskey-bourbon%2Cwhiskey-single-malt/';

    public function index()
    {
    	$parse = new CrawlerParse();
    	$html = $parse->getPage($this->URL);
    	$parse->parse($html);
    }
}
