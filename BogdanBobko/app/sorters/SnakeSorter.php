<?php

namespace CSR\App\Sorters;

class SnakeSorter extends BaseSorter
{
	protected $title = "Snake sorting.";
	
	public function sort()
	{
		$this->sortedArray = $this->array;
	}
}
