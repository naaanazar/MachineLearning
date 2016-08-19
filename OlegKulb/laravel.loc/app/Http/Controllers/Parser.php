<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use DOMDocument;
use DOMXpath;
use App\Product;

class Parser extends Controller
{
    private $curl;
    private $url = 'http://rozetka.com.ua/notebooks/c80004/filter/preset=netbooks/';
    private $selector = "//div[contains(@class, 'g-i-tile-i-title')]/a";
    private $selector2 = "//ul[contains(@class, 'g-i-tile-short-detail')]/li";
    private $selector3 = "//div[contains(@class, 'g-i-tile-i-image')]/a/img";
    private $resource;
    private $dom;
    private $elements = [];
    private $hreflist = [];
    private $productName = [];
    private $description = [];
    private $img = [];

    public function curl($url)
    {
        $this->curl = curl_init($url);
        curl_setopt($this->curl, CURLOPT_HEADER, 0);
        curl_setopt($this->curl, CURLOPT_ENCODING, "");
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
        $this->resource = curl_exec($this->curl);
        
    }

    public function createDom()
    {
        $this->dom = new DOMDocument();

        libxml_use_internal_errors(true);
        $this->dom->loadHTML(mb_convert_encoding($this->resource, 'HTML-ENTITIES', 'UTF-8'));
//        libxml_clear_errors();
    }

    public function createLinkList()
    {
        $xpath = new DOMXpath($this->dom);
        //for href and products name

        $this->elements = $xpath->query($this->selector);

        foreach ($this->elements as $value) {
            array_push($this->hreflist, $value->getAttribute('href'));
            array_push($this->productName, trim($value->textContent));
        }
        //for description

        $this->elements = $xpath->query($this->selector2);

        foreach ($this->elements as $value) {
            array_push($this->description, trim($value->textContent));
        }
        //for img
        
        $this->elements = $xpath->query($this->selector3);

        foreach ($this->elements as $value) {
            array_push($this->img, $value->getAttribute('data_src'));
        }
    }

    public function parser()
    {
        $this->curl($this->url);
        $this->createDom();
        $this->createLinkList();

        echo '<pre>';
        print_r($this->hreflist);
        print_r($this->productName);
        print_r($this->description);
        print_r($this->img);
        die();
    }

    public function setProducts()
    {
        $this->curl($this->url);
        $this->createDom();
        $this->createLinkList();

        foreach ($this->productName as $key => $value) {
            $products = new Product;
            $products->title = $this->productName[$key];
            $products->description = $this->description[$key];
            $products->img_url = $this->img[$key];
            $products->save();
        }

        

    }
}
