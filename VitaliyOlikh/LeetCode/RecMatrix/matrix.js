function maximalRectangle(matrix) {
    var m = matrix.length;
    var n = m == 0 ? 0 : matrix[0].length;
    var height = [];
    
    for (var i = 0; i < m; i++) {
        var temp = [];
        for (var j = 0; j < n+1; j++) {
            temp.push(0);
        }
        height.push(temp);
    }
    
    var maxArea = 0;
    for (var i = 0; i < m; i++) {
        for (var j = 0; j < n; j++) {
            if (matrix[i][j] == '0') {
                height[i][j] = 0;
            } else {
                height[i][j] = i == 0 ? 1 : height[i - 1][j] + 1;
            }
        }
    }
 
    for (var i = 0; i < m; i++) {
        var area = maxAreaInHist(height[i]);
        if (area > maxArea) {
            maxArea = area;
        }
    }
 
    return maxArea;
}
 
function maxAreaInHist(height) {
    var stack = [];
 
    var i = 0;
    var max = 0;
 
    while (i < height.length) {
        if (stack.length == 0 || height[stack[stack.length - 1]] <= height[i]) {
            stack.push(i++);
        } else {
            var t = stack.pop();
            max = Math.max(max, height[t]
                    * (stack.length == 0 ? i : i - stack[stack.length - 1] - 1));
        }
    }
 
    return max;
}


var matrix = [
    [1,0,1,0,0],
    [1,0,1,1,1],
    [1,1,1,1,1],
    [1,0,0,1,0]
];

var res = maximalRectangle(matrix);

document.getElementById("matrix").innerHTML = res;