<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Nazar\Parser;

use App\Product;

class ParserController extends Controller
{

    public function index()
    {                
        $parser = new Parser();
        $pageToParse = 'http://rozetka.com.ua/pivo/c4626589/';
        $data = $parser->parse($pageToParse);

        $path = "//div[contains(@class, 'g-i-tile-i-title')]/a";
        $pages = $parser->getPages($data, $path);
        foreach ($pages as $page) {
            $products = $parser->getProductContent($page);
        }

        $parser->writeInCsv($products);
        
        $products = $parser->getFromCsv("products.csv");


        foreach ($products as $product) {
            $item = new Product();
            $item->title = $product[0];
            $item->img= $product[1];
            $item->description = $product[2];
            $item->save();
        }


        response();
    }
}
