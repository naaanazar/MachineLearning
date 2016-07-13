<?php

namespace App\Sorters;

require_once 'BaseSorter.class.php';

class VerticalSorter extends BaseSorter
{
	protected $title = "Vertical sorting.";
	private $reversed = false;

	public function __construct($reversed = false)
	{
		$this->reversed = $reversed;
	}

	public function sort()
	{
		for ($iteration = 0; $iteration < ($this->arrayLength - $this->rowLength); $iteration++) {
			$offset = 0;

			for ($index = $iteration; $index < ($this->arrayLength - $this->rowLength); $index += $this->rowLength) {
				$this->sortedArray[$index] = $this->array[$offset + $index];

				$offset++;
			}
		}

//		echo '<pre>';
//		print_r($this->sortedArray);
//		die('OK');
	}
}
