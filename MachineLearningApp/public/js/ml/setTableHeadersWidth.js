function setTableHeadersWidth(containerId)
{
    var headerCols = $('#' + containerId + ' .table-headers > span');
    var cols = $('#' + containerId + ' table tbody tr:first-child td');
    var height_arr = [];

    for(var i = 0; i < cols.length; i++ ) {
        var colWidth = $(cols[i]).outerWidth();
        $(headerCols[i]).outerWidth(colWidth);
        height_arr.push($(headerCols[i]).outerHeight());
    }

    var max = Math.max(...height_arr);

    var f = function(...headerCols) {
        $(headerCols).outerHeight(max);
    }

    f(...headerCols);

    $('.container-' +containerId).css({
        top: max
    });

}