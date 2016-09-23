$(document).ready(function () {

    if (window.location.hash == '#describeDataSources' || window.location.hash === '') {
        buttonCreate('btn-create-datasource', '#ml-button-create', 'Create Datasource', '#modalCreateDataSource');
        listDataSource('ok');
    };

    $('.create-datasource-form').submit(function (e) {
        e.preventDefault();
        showLoader('.container-describeDataSources');

        $.ajax({
            type: "post",
            url: '/ml/create-datasource',
            data: $('.create-datasource-form').serialize(),
            success: function (response) {
                console.log(response.data);
                $(".modalCreateDataSource").modal('toggle');
                listDataSource(data);
            }           
        });
    });

    $(document).on("click", ".btn-create-datasource", function () {
        selectDataFromS3('/ml/select-S3objects', '#SelectDataLocationS3', '.create-datasource-form');
    });

    $(document).on("click", '#describeDataSourcesContent', function () {
        buttonCreate('btn-create-datasource', '#ml-button-create', 'Create Datasource', '#modalCreateDataSource');

        if (!$('.container-describeDataSources').hasClass('loaded')) {
            listDataSource('ok');
        };
    });

});

function listDataSource(status)
{
    showLoader('.container-describeDataSources');
    statusAction(status);

    $.get("/ml/describe-data-sources?Obj=ml", function (response) {

        var i = 1;
        var res = '' +
            '<table class="table table-bordered table-font text-center">';
//                '<thead>' +
//                '<tr class="active">' +
//                '<th>Name</th>' +
//                '<th>Status</th>' +
//                '<th>Data Location S3</th>' +
//                '<th>Last Updated</th>' +
//                '<th>&nbsp;</th>' +
//                '</tr>' +
//                '</thead>' +
//                '<span class="hide">' + i + '</span>';

        for (var key in response.data) {
            i = i + 1;          
            res += '' +
            '<tr>' +
                '<td class="hide">' + response.data[key].DataSourceId + '</td>' +
                '<td class="name">' + checkVariable(response.data[key].Name) +
                '</td>' +
                '<td class="' + statusTextColor(response.data[key].Status) + '">' + response.data[key].Status + '</td>' +
                '<td>' + response.data[key].DataLocationS3 + '</td>' +
                '<td>' + timeConverter(response.data[key].LastUpdatedAt) + '</td>' +
                '<td>' +
                    '<a class="btn btn-info btn-sm btn-list datasource-info" href="#modal"' + 'data-toggle="modal" id="info_' + i
                        + '" data-source-id="' + response.data[key].DataSourceId + '">' +
                        '<span class="glyphicon glyphicon-info-sign"></span>' +
                    '</a>&nbsp;' +
                    '<a class="btn btn-danger btn-sm btn-list delete" href="#" data-delete-id="' + response.data[key].DataSourceId + '">' +
                        '<span class="glyphicon glyphicon-trash"></span>'
                    '</a>' +
                '</td>' +
            '</tr>' +
            '<span class="hide">' + i + '</span>';
        };

        res += '</table>';

        var headers = ''+
            '<div class="table-headers">' +
                '<span>Name</span>' +
                '<span>Status</span>' +
                '<span>Dataset</span>' +
                '<span>Last Updated</span>' +
                '<span>Action</span>' +
            '</div>';

        $('.container-describeDataSources').html(res);
        $('.container-describeDataSources').before(headers);
        setTableHeadersWidth();
        $('.container-describeDataSources').addClass('loaded');
    });
};

function setTableHeadersWidth()
{
    var headerCols = $('.table-headers > span');
    var cols = $('#describeDataSources table tbody tr:first-child td');

    for(var i = 1; i < cols.length; i++ ) {
        var colWidth = $(cols[i]).outerWidth();
        console.log(colWidth);
        $(headerCols[i-1]).outerWidth(colWidth);
    }
}
