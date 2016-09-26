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
            success: function (data) {            
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
            '<table class="table table-bordered table-font text-center">' +
                '<tr class="active">' +
                    '<td>Name</th>' +
                    '<td>Status</th>' +
                    '<td>Data Location S3</th>' +
                    '<td>Last Updated</th>' +
                    '<td>Action</th>' +
                '</tr>' +
                '<span class="hide">' + i + '</span>';

        for (var key in response.data) {
            i = i + 1;          
            res += '' +
            '<tr>' +
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
                        '<span class="glyphicon glyphicon-trash"></span>' +
                    '</a>' +
                '</td>' +
            '</tr>' +
            '<span class="hide">' + i + '</span>';
        };

        res += '</table>';

        $('.container-describeDataSources').html(res);
     
        $('.container-describeDataSources').addClass('loaded');
    });
};
