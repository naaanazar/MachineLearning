<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Mykhailo\Parser;

class ParserController extends Controller
{
    public function index()
    {


        $ch = curl_init('http://comfy.ua/brush-cutters/');

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/534.10 (KHTML, like Gecko) Chrome/8.0.552.224 Safari/534.10');


        $page = curl_exec($ch);

        $doc = \phpQuery::newDocument($page);


        foreach ($doc as $ti) {
            $ti = pq(pq('img.js-product-main-img '));
            echo $ti;
            echo "<br>";
            $ti = pq(pq('p.products-tiles__cell__name'))->text();
            echo $ti;
            echo "<br>";
            $ti = pq(pq('p.products-tiles__sku'))->text();
            echo $ti;
            echo "<br>";
            $ti = pq(pq('div.price-box__content'))->text();
            echo $ti;


        }


        \phpQuery::unloadDocuments($doc);

        curl_close($ch);

    }
}