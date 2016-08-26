<?php

namespace Yarik;

use App\Http\Controllers\ParserController;
use phpQuery;

class Parser {
    public function fetchPage($url) {

        $fs = fopen('bazaParser.csv', 'w');

        $html = file_get_contents($url);
        $doc = phpQuery::newDocument($html);

        $products = pq('td.products-tiles__cell');

        foreach ($products as $product)
        {
            $prod = pq($product);

            $productName = $prod->find('a.js-product-title')->text();
            $productPrice = $prod->find('div.price-box__content')->text();
            $productDescription = $prod->find('div.options')->text();
            $productImg = $prod->find('img.js-product-main-img');
            $productImgUrl = $prod->find('img.js-product-main-img')->attr('src');

            $productNameNew = preg_replace('!\s+!', ' ',$productName);
            $productPriceNew = preg_replace('!\s+!', ' ',$productPrice);
            $productImgUrlNew = preg_replace('!\s+!', ' ',$productImgUrl);
            $productDescriptionNew = preg_replace('!\s+!', ' ', $productDescription);

            fputcsv ($fs, array ($productNameNew, $productPriceNew, $productDescriptionNew, $productImgUrlNew));

            echo '<br /><------------------------><br />';
            echo $productNameNew . '<br />' . $productPriceNew . '<br />' . $productDescriptionNew . '<br />' . $productImg . '<br />' . $productImgUrlNew;
        }
        
        fclose($fs);
        phpQuery::unloadDocuments($doc);
    }
}