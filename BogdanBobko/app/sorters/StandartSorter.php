<?php

namespace CSR\App\Sorters;

class StandartSorter extends BaseSorter
{
	protected $title = "Standart sorting.";

	public function sort()
	{
		if ($this->reversed) {
			$this->reverseSort();
		} else {
			$this->sortedArray = $this->array;
		}
	}

	private function reverseSort()
	{
		$_rowIndex = 0;

		for ($rowIndex = ($this->rowsCount - 1); $rowIndex >= 0; $rowIndex--) {
			$_itemIndex = 0;

			for ($itemIndex = ($this->itemsCount - 1); $itemIndex >= 0; $itemIndex--) {
				$item = $this->array[$rowIndex][$itemIndex];
				$this->sortedArray[$_rowIndex][$_itemIndex] = $item;

				$_itemIndex++;
			}

			$_rowIndex++;
		}
	}
}
