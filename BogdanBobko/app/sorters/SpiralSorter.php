<?php

namespace CSR\App\Sorters;

class SpiralSorter extends BaseSorter
{
	protected $title = "Spiral sorting.";

	public function sort()
	{
		$this->sortedArray = $this->array;
	}
}
