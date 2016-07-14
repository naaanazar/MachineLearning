<?php

namespace CSR\App\Sorters;

class VerticalSorter extends BaseSorter
{
	private $reversed = false;

	protected $title = "Vertical sorting.";

	public function __construct($reversed = false)
	{
		$this->reversed = $reversed;
	}

	public function displayTitle() {
		if ($this->reversed) {
			echo PHP_EOL . "Reversed vertical sorting." . PHP_EOL;
		} else {
			parent::displayTitle();
		}
	}

	public function sort()
	{
		$this->sortedArray = $this->array;
	}
}
