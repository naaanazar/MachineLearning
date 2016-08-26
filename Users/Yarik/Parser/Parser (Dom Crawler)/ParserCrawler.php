<?php

namespace Yarik;

use Symfony\Component\DomCrawler\Crawler;

class ParserCrawler {
    public function fetchPage($url)
    {
        $fs = fopen('bazaParserCrawler.csv', 'w');

        $html = file_get_contents($url);
        $crawler = new Crawler($html);

        $products = $crawler->filter('td.products-tiles__cell');
        
        foreach ($products as $domElement) {

            $product = new Crawler($domElement);

            $productName = $product->filter('p.products-tiles__cell__name > a')->text();
            $productPrice = $product->filter('div.price-box__content')->text();
            $productDescription = $product->filter('div.options')->text();
            $productImgUrl = $product->filter('img.js-product-main-img')->attr('src');

            $productNameNew = preg_replace('!\s+!', ' ',$productName);
            $productPriceNew = preg_replace('!\s+!', ' ',$productPrice);
            $productImgUrlNew = preg_replace('!\s+!', ' ',$productImgUrl);
            $productDescriptionNew = preg_replace('!\s+!', ' ', $productDescription);

            fputcsv ($fs, array ($productNameNew, $productPriceNew, $productDescriptionNew, $productImgUrlNew));

            echo "<br />----------------------------------------------------------------<br />";
            echo $productNameNew . "<br />" . $productPriceNew . "<br />" . $productDescriptionNew . "<br />" . $productImgUrl . "<br /><img src='$productImgUrlNew'>";
        }
        fclose($fs);
    }
}