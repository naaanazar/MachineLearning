<?php

class Solution
{
	public function maximalRectangle($matrix)
	{
		$m = count($matrix);
		$n = $m == 0 ? 0 : count($matrix[0]);

		$height = [];

		for ($i = 0; $i < $m; $i++) {
			$temp = [];
			for ($j = 0; $j < $n + 1; $j++) {
				array_push($temp, 0);
			}
			array_push($height, $temp);
		}

		$maxArea = 0;

		for ($i = 0; $i < $m; $i++) {
			for ($j = 0; $j < $n; $j++) {
				if ($matrix[$i][$j] == '0') {
					$height[$i][$j] = 0;
				} else {
					$height[$i][$j] = $i == 0 ? 1 : $height[$i - 1][$j] + 1;
				}
			}
		}

		for ($i = 0; $i < $m; $i++) {
			$area = $this->maxAreaInHist($height[$i]);
			if ($area > $maxArea) {
				$maxArea = $area;
			}
		}

		return $maxArea;
	}

	private function maxAreaInHist($height)
	{
		$stack = [];

		$i = 0;
		$max = 0;

		while ($i < count($height)) {
			if (count($stack) == 0 || $height[$stack[count($stack) -1]] <= $height[$i]) {
				array_push($stack, $i++);
			} else {
				$t = array_pop($stack);
				$max = max($max, $height[$t] * (count($stack) == 0 ? $i : $i - $stack[count($stack) - 1] - 1));
			}
		}
		return $max;
	}
}

$matrix = [
    [1,0,1,0,0],
    [1,0,1,1,1],
    [1,1,1,1,1],
    [1,0,1,1,1]
];

$obj = new Solution();

echo $obj->maximalRectangle($matrix);