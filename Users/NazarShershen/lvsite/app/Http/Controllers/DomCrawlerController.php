<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Nazar\Parser;

use Symfony\Component\DomCrawler\Crawler;

class DomCrawlerController extends Controller
{
    public function index()
    {
        $parser = new Parser();
        $pageToParse = 'http://rozetka.com.ua/pivo/c4626589/';
        $data = $parser->parse($pageToParse);

        
        
        $crawler = new Crawler($data);
        $crawler->filter('div.g-i-tile-i-title a');
        
    }
}
