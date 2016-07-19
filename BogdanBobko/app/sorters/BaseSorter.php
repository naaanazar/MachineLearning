<?php

namespace CSR\App\Sorters;

abstract class BaseSorter {
	protected $reversed = false;

	protected $rowsCount = 0; // number of rows
	protected $itemsCount = 0; // number of items in a row

	protected $array = array();
	protected $sortedArray = array();

	private $maxItemOffset = 1;

	protected $title = "Base sorting.";

	public function __construct($reversed = false)
	{
		$this->reversed = $reversed;
	}

	abstract public function sort();

	public function setArray($array)
	{
		$this->array = $array;
		$this->rowsCount = count($array);
		$this->itemsCount = count($array[0]);
	}

	public function displayTitle()
	{
		$title = $this->reversed ? "Revesed " . strtolower($this->title) : $this->title;
		echo PHP_EOL . $title . PHP_EOL;
	}

	public function display()
	{
		$this->getMaxItemOffset();

		foreach ($this->sortedArray as $row) {
			foreach ($row as $rowItem) {
				$this->displayArrayItem($rowItem);
			}

			echo PHP_EOL;
		}
	}

	private function displayArrayItem($item)
	{
		echo ' ';

		if (strlen($item) <= $this->maxItemOffset) {
			for ($i = 0; $i < ($this->maxItemOffset - strlen($item)); $i++) {
				echo ' ';
			}

			echo $item;
		}
	}

	private function getMaxItemOffset()
	{
		foreach ($this->sortedArray as $row) {
			foreach ($row as $rowItem) {
				if (strlen($rowItem) > $this->maxItemOffset) {
					$this->maxItemOffset = strlen($rowItem);
				}
			}
		}
	}
}
