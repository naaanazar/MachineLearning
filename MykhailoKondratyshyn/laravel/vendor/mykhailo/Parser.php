<?php

namespace Mykhailo;

use App\Http\Controllers\ParserController;


class Parser
{
    public function fetchPage($url)
    {
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/534.10 (KHTML, like Gecko) Chrome/8.0.552.224 Safari/534.10');



        $page = curl_exec($ch);

$doc = \phpQuery::newDocument($page);

        $title = pq('g-i-tile-l clearfix')->find('g-i-tile g-i-tile-catalog g-i-large-tile-catalog');







        \phpQuery::unloadDocuments($doc);





//        foreach ($title as $html){
//            echo($html);
//            echo "<br>";
//        }


        curl_close($ch);
        return $title;
    }
}


