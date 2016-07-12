<?php

namespace App\Sorters;

require_once 'BaseSorter.class.php';

class VerticalSorter extends BaseSorter
{
	protected $title = "Vertical sorting.";
	private $reversed = false;

	public function __construct($reversed = false)
	{
		$this->reversed = $reversed;
	}

	public function sort()
	{
		
	}
}
