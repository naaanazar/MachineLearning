<?php

namespace App\Sorters;

require_once 'BaseSorter.class.php';

class StandartSorter extends BaseSorter
{
	protected $title = "Standart sorting.";

	public function sort()
	{
		$this->sortedArray = $this->array;
	}
}
