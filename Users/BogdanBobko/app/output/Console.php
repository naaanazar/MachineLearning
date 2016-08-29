<?php

namespace CSR\App\Output;

class Console {
	private $array = array();
	private $maxItemOffset = 0;

	public function setArray($array)
	{
		$this->array = $array;
	}

	public function plainDisplay($message)
	{
		echo $message;
	}

	public function arrayDisplay()
	{
		$this->getMaxItemOffset();

		foreach ($this->array as $row) {
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
		foreach ($this->array as $row) {
			foreach ($row as $rowItem) {
				if (strlen($rowItem) > $this->maxItemOffset) {
					$this->maxItemOffset = strlen($rowItem);
				}
			}
		}
	}
}
