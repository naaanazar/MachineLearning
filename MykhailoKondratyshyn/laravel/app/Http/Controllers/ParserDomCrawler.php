<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\Finder\Finder;

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

$fp = fopen('file.csv', 'w');
        foreach ($crawler as $domElement) {
            $rowCrawler = new Crawler($domElement);
            $productImgUrl = $rowCrawler->filter('img.js-product-main-img')->attr('src');
            echo "<img src='$productImgUrl'>";
            echo "<br>";
            echo "<br>";
            fputcsv($fp, trim($rowCrawler->filter('.products-tiles__cell__name')->text()));
            echo "<br>";
            fputcsv($fp, trim($rowCrawler->filter('.price-box__content')->text()));
            echo "<br>";
            echo "<br>";
        }
        fclose($fp);
        curl_close($ch);
    }
}


