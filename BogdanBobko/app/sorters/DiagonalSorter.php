<?php

namespace CSR\App\Sorters;

class DiagonalSorter extends BaseSorter
{
	private $reversed = false;

	protected $title = "Diagonal sorting.";

	public function __construct($reversed = false)
	{
		$this->reversed = $reversed;
	}

	public function displayTitle() {
		if ($this->reversed) {
			echo PHP_EOL . "Reversed diagonal sorting." . PHP_EOL;
		} else {
			parent::displayTitle();
		}
	}

	public function sort()
	{
		$this->sortedArray = $this->array;
	}
}
