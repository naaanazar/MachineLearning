function setTableHeadersWidth(containerId)
{
    var headerCols = $('#' + containerId + ' .table-headers > span');
    var cols = $('#' + containerId + ' table tbody tr:first-child td');

    for(var i = 0; i < cols.length; i++ ) {
        var colWidth = $(cols[i]).outerWidth();
        console.log(colWidth);
        $(headerCols[i]).outerWidth(colWidth);
    }
}