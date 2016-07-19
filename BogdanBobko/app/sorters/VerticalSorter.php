<?php

namespace CSR\App\Sorters;

class VerticalSorter extends BaseSorter
{
	protected $title = "Vertical sorting.";

	public function sort()
	{
		$this->sortedArray = $this->array;
	}
}
