<?php

namespace CSR\App\Sorters;

class VerticalSorter extends BaseSorter
{
	protected $title = "Vertical sorting.";

	public function sort()
	{
		if ($this->reversed) {
			$this->reverseSort();
		} else {
			$this->straightSort();
		}
	}

	public function straightSort()
	{
		$rowCounter = $itemCounter = 0;

		for ($itemIndex = 0; $itemIndex < $this->itemsCount; $itemIndex++) {
			for ($rowIndex = 0; $rowIndex < $this->rowsCount; $rowIndex++) {
				$this->sortedArray[$rowIndex][$itemIndex] = $this->array[$rowCounter][$itemCounter];

				if (++$itemCounter === $this->itemsCount) {
					$itemCounter = 0;
				}
			}

			if (++$rowCounter === $this->rowsCount) {
				$rowCounter = 0;
			}
		}
	}

	public function reverseSort()
	{
		$rowCounter = $itemCounter = $this->itemsCount - 1;

		for ($itemIndex = ($this->itemsCount - 1); $itemIndex >= 0; $itemIndex--) {
			for ($rowIndex = ($this->rowsCount - 1); $rowIndex >= 0; $rowIndex--) {
				$this->sortedArray[$rowIndex][$itemIndex] = $this->array[$rowCounter][$itemCounter];

				if (--$itemCounter < 0) {
					$itemCounter = $this->itemsCount - 1;
				}
			}

			if (--$rowCounter < 0) {
				$rowCounter = $this->rowsCount - 1;
			}
		}
	}
}
