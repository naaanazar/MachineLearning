<?php

namespace CSR\App\Sorters;

abstract class BaseSorter {
	protected $reversed = false;

	protected $rowsCount = 0;
	protected $itemsCount = 0;

	protected $array = array();
	protected $sortedArray = array();

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

	public function getSortedArray()
	{
		return $this->sortedArray;
	}

	public function getTitle()
	{
		return $this->reversed ? "Revesed " . strtolower($this->title) : $this->title;
	}
}
