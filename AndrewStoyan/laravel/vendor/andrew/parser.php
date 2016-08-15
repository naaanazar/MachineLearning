<?php

namespace Andrew;


/**
* 
*/
class Parser 
{
	public $ch;
	public $resource;
	public $DOM;
	public $xpath = "//div[@class='g-i-tile-i-title clearfix']/a";
	public $xpath1 = "//h1[@class='detail-title']";
	public $xpath2 = "//div[@id='basic_image']/div[@class='responsive-img']/img";
	public $xpath3 = "//div[@id='short_text']/p";
	public $elements;
	public $elements1;
	public $hreflist = [];
	public $content = [];

	public function curl($url)
	{
		$this->ch = curl_init($url);
		curl_setopt($this->ch, CURLOPT_HEADER, 0);
		curl_setopt($this->ch, CURLOPT_ENCODING, "");
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
		$this->resource = curl_exec($this->ch);
	}

	public function createDOM()
	{
		$this->DOM = new \DOMDocument();
		libxml_use_internal_errors(true);
		$this->DOM->loadHTML(mb_convert_encoding($this->resource, 'HTML-ENTITIES', 'UTF-8'));
		libxml_clear_errors();
	}	

	public function createLinkList()
	{
		$xpath = new \DOMXpath($this->DOM);
		$this->elements = $xpath->query($this->xpath);
		echo "<pre>";
		foreach ($this->elements as $value) {
			array_push($this->hreflist, $value->getAttribute('href'));
		}
		
	}

	public function getContent()
	{
		foreach ($this->hreflist as $key => $value) {
			$this->curl($value);
			$this->createDOM();
			$xpath = new \DOMXpath($this->DOM);
			$content = [];
			$this->elements1 = $xpath->query($this->xpath1);
			array_push($content, trim($this->elements->item(0)->nodeValue));
			$this->elements1 = $xpath->query($this->xpath2);
			array_push($content, trim($this->elements1->item(0)->getAttribute('src')));
			$this->elements1 = $xpath->query($this->xpath3);
			array_push($content, trim($this->elements1->item(0)->nodeValue));
			array_push($this->content, $content);
		}

		$fp = fopen('file.csv', 'w');

		foreach ($this->content as $fields) {
	    	fputcsv($fp, $fields);
		}

		fclose($fp);
	}
}
