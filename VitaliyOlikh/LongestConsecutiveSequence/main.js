function longestConsecutive(num) {
	if (num.length == 0) {
		return false;
	}

	var set = [];
	var max = 1;

	for (var i=0; i < num.length; i++) set.push(num[i]);

	for (var i = 0; i < num.length; i++) {
		var left = num[i] - 1;
		var right = num[i] + 1;
		var count = 1;

		while (set.indexOf(left) != -1) {
			count++;
			set.splice(set.indexOf(left), 1);
			left--;
		}
		while (set.indexOf(right) != -1) {
			count++;
			set.splice(set.indexOf(right), 1);
			right++;
		}

		max = Math.max(count, max);
	}

	return max;
}

console.log(longestConsecutive([4,3,2,0,8]));