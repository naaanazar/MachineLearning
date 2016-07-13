<?php

namespace CSR\App\Sorters;

abstract class BaseSorter {
	protected $array = array();
	protected $arrayLength = 0;
	protected $rowLength = 10;
	protected $sortedArray = array();

	protected $title = "Base sorting.";

	abstract public function sort();

	public function setArray($array)
	{
		$this->array = $array;
		$this->arrayLength = count($array);
	}

	public function displayTitle()
	{
		echo PHP_EOL . $this->title . PHP_EOL;
	}

	public function display()
	{
		foreach ($this->sortedArray as $index => $arrayItem) {
			if ($index > 0 && is_int($index / $this->rowLength)) {
				echo PHP_EOL;
			}

			echo ' ';

			if (strlen($arrayItem) < strlen($this->arrayLength)) {
				for ($i = 0; $i < (strlen($this->arrayLength) - strlen($arrayItem)); $i++) {
					echo ' ';
				}
			}

			echo $arrayItem;
		}

		echo PHP_EOL;
	}
}
