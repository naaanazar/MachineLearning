<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Symfony\Component\DomCrawler\Crawler;

class ParserDomCrawler extends Controller
{
    public function index()
    {

        $ch = curl_init('http://comfy.ua/brush-cutters/');

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/534.10 (KHTML, like Gecko) Chrome/8.0.552.224 Safari/534.10');


        $html = curl_exec($ch);

        $dom = new Crawler($html);
        $crawler = $dom->filter('.products-tiles__cell');


        //$crawler = $crawler->filter('.products-tiles__cell__name');
//        for ($i = 0; $i<=$crawler; $i++){
//
//            $crawler = $crawler->filter('.products-tiles__cell__name')->eq($i)->html();
            //print_r($crawler);
//
//
//        }


        foreach ($crawler as $domElement) {
       // $domElement = $domElement;
            $rowCrawler = new Crawler($domElement);
            //echo "<pre>";
        print_r(trim($rowCrawler->filter('.products-tiles__cell__name')->text()));
        //print_r(trim($rowCrawler->filter('a')->text()));
            echo "<br>";
        }

        curl_close($ch);
    }
}
