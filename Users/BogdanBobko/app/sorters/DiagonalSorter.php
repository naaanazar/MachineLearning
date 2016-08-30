<?php

namespace CSR\App\Sorters;

class DiagonalSorter extends BaseSorter
{
	protected $title = "Diagonal sorting.";

	public function sort()
	{
		$this->sortedArray = $this->array;
	}
}
