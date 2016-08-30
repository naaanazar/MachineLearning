<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Maryna\Parser;
use App\Product;

class ParserController extends Controller
{

    public function index()
    {

//        echo "<link rel='stylesheet' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>";
//        echo "<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'></script>";
//        echo "<script src='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>";

        $parser = new Parser();
//        $pageToParse = 'http://rozetka.com.ua/eyes_makeup/c2048492/56037=158107/';
//        $data = $parser->parse($pageToParse);
//
//        $path = "//div[contains(@class, 'g-i-tile-i-title')]/a";
//        $pages = $parser->getPages($data, $path);
//        foreach ($pages as $page) {
//            $products = $parser->getProductContent($page);
//        }

//        foreach ($products as $item) {
//            $displayItem = "";
//            $displayItem .= "<div class='col-md-4'>";
//            $displayItem .= "<h3>" . $item['title'] . "</h3>";
//            $displayItem .= "<img src='" . $item['image'] . "'>";
//            $displayItem .= "<p>" . substr($item['description'], 0, 200) . "...</p>";
//            $displayItem .= "</div>";
//            echo $displayItem;
//        }
        $products = $parser->getFromCsv("products.csv");
        foreach ($products as $product) {
            $item = new Product();
            $item->title = $product[0];
            $item->img = $product[1];
            $item->description = $product[2];
            $item->save();
        }
    }

}
