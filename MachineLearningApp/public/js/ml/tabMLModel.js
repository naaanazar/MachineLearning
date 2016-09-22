$(document).ready(function() {

    if (window.location.hash == '#describeMLModels') {
        buttonCreate('btn-create-mlmodel', '#ml-button-create', 'Create ML Mode', '#modalCreateModel');
        listMLModel();
    };

    $(document).on('mouseenter', '.delete-endpoint', function (e) {
        e.preventDefault();

        $.jGrowl('delete RealtimeEndpoint', {
            theme: 'jgrowl-notification'
        });
    });

    $('.create-mlmodel-form').submit(function(e) {
        e.preventDefault();


        $.ajax({
            type: "post",
            url: 'ml/create-ml-model',
            data: $('.create-mlmodel-form').serialize(),
            success: function(data) {
                $(".modalCreateModel").modal('toggle');
                listMLModel();
                console.log(data);
            },
            error: function() {},
        });
    });

    $(document).on("click", ".btn-create-mlmodel", function() {
        selectName('/ml/select-data-source', '#SelectDataSource', '.create-mlmodel-form');
    });

    $(document).on("click", '#describeMLModelsContent', function () {
        buttonCreate('btn-create-mlmodel', '#ml-button-create', 'Create ML Mode', '#modalCreateModel');

        if(!$('.container-describeMLModels').hasClass('loaded')) {
            listMLModel();
        }
    });

    $(document).on('click', '.delete-endpoint', function (e) {
        e.preventDefault();

        $.post('/ml/delete-endpoint', {
           id: $(this).data('model-id') }, function (data) {
           $(e.target).closest("tr").find('.status-endpoint').text('NONE');

           $(e.target).closest("tr").find('.delete-endpoint').addClass('disabled');
       });
   });
});

function listMLModel()
{
    showLoader('.container-describeMLModels');

    $.get("/ml/describe-ml-model", function(response) {
        var i = 1;
        var res = '' +
            '<table class="table table-bordered table-font text-center">' +
                '<tr class="active">' +
                    '<td>Name</td>' +
                    '<td>Status</td>' +
                    '<td>Endpoint Status</td>' +
                    '<td>ML Model Type</td>' +
                    '<td>Last Updated</td>' +
                    '<td>Action</td>' +
                '</tr>' +
            '<span class="hide">' + i + '</span>';

        for (var key in response.data) {
            i = i + 1;
            var date = parseDate(response.data[key].LastUpdatedAt);
            var classText = statusTextColor(response.data[key].Status);

            if (response.data[key].EndpointInfo.EndpointStatus == 'READY') {
                endpointDisabled = '';
                endpointStatus = 'ENABLED';
                colorTextEndpointStatus = 'text-danger';
            } else {
                endpointDisabled = 'disabled btn-default';
                endpointStatus = 'DISABLED';
                colorTextEndpointStatus = 'text-success';
            };

            res += '' +
            '<tr>' +
                '<td class="name">';

            if (response.data[key].Name !== undefined) {
                res += response.data[key].Name;
            };

            res += '' +
                '</td>' +
                '<td class="' + classText + '">' + response.data[key].Status + '</td>' +
                '<td class="status-endpoint ' + colorTextEndpointStatus + '">' + endpointStatus + '</td>' +
                '<td>' + response.data[key].MLModelType + '</td>' +
                '<td>' + date + '</td>' +
                '<td style="width:140px" nowrap>' +
                    '<a class="btn btn-warning btn-sm btn-list delete-endpoint ' + endpointDisabled + '" href="#modal"' +
                        'id="info_' + i + '" data-model-id="' + response.data[key].MLModelId + '">' +
                        '<span class="glyphicon glyphicon-remove-circle"></span></a>&nbsp;' +
                    '<a class="btn btn-info btn-sm btn-list datasource-info" href="#modal"' +
                        'data-toggle="modal" id="info_' + i + '" data-source-id="' + response.data[key].MLModelId + '">' +
                        '<span class="glyphicon glyphicon-info-sign"></span></a>&nbsp;' +
                    '<a class="btn btn-danger btn-sm btn-list delete" href="#" data-delete-id="' + response.data[key].MLModelId + '">\n' +
                        '<span class="glyphicon glyphicon-trash"></span></a>' +
                '</td>' +
            '</tr>' +
            '<span class="hide">' + i + '</span>';
        };

        res += '</table>';

        $('.container-describeMLModels').html(res);
        $('.container-describeMLModels').addClass('loaded');
    });
};