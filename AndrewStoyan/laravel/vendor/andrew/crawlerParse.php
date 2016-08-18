<?php

namespace Andrew;

use Symfony\Component\DomCrawler\Crawler;
/**
* 
*/
class CrawlerParse
{
	public function getPage($url)
	{
		return file_get_contents($url);
	}

	public function parse($html)
	{
		$crawler = new Crawler($html);
		$crawler = $crawler->filter("div[class='g-i-tile-i-title clearfix'] > a");
		echo "<pre>";
		var_dump($crawler);
		
	}
}
