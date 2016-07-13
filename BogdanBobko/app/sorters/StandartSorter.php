<?php

namespace CSR\App\Sorters;

class StandartSorter extends BaseSorter
{
	protected $title = "Standart sorting.";

	public function sort()
	{
		$this->sortedArray = $this->array;
	}
}
