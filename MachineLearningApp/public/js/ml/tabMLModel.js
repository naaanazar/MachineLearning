$(document).ready(function() {

    if (window.location.hash == '#describeMLModels') {
        buttonCreate('btn-create-mlmodel', '#ml-button-create', 'Create ML Model', '#modalCreateModel');
        listMLModel('ok');
        $(".ml-button-block").hide().fadeOut();
        $(".ml-table").fadeIn();
    };

    $('.create-mlmodel-form').submit(function(e) {
        e.preventDefault();
        run_waitMe('#modal-ml-id');

        $.ajax({
            type: "post",
            url: 'ml/create-ml-model',
            data: $('.create-mlmodel-form').serialize(),
            error: function(XMLHttpRequest){
                if (XMLHttpRequest.status == '422') {
                    $(document).ready(function () {
                        $.jGrowl("Incorrect name. Please reload page or try again later!", {
                            sticky: true,
                            theme: 'jgrowl-danger'
                        });
                    });
                }
            },
            success: function(data) {
                $('#MLModelName').val('');
                $(".modalCreateModel").modal('toggle');
                listMLModel(data[0]);
                waitMeClose('#modal-ml-id');
            },
        });
    });

    $(document).on("click", ".btn-create-mlmodel", function() {
       $('.create-mlmodel-form')[0].reset();
        selectName('/ml/select-data-source?Obj=ml', '#SelectDataSource', '.create-mlmodel-form');
    });

    $(document).on("click", '#describeMLModelsContent', function () {
        buttonCreate('btn-create-mlmodel', '#ml-button-create', 'Create ML Model', '#modalCreateModel');

        if(!$('.container-describeMLModels').hasClass('loaded')) {
            listMLModel('ok');
        }
    });

    $(document).on('click', '.delete-endpoint', function (e) {
        e.preventDefault();

        $.post('/ml/delete-endpoint', {
           id: $(this).data('model-id') }, function (data) { 
           $(e.target).closest("tr").find('.status-endpoint').text('DISABLED');
           
           $(e.target).closest("tr").find('.status-endpoint').removeClass('text-danger');
           $(e.target).closest("tr").find('.status-endpoint').addClass('text-success');
           $(e.target).closest("tr").find('.delete-endpoint').addClass('disabled');
       });
   });
});

function listMLModel(status)
{
    showLoader('.container-describeMLModels');
    statusAction(status);

    $.get("/ml/describe-ml-model?Obj=ml", function(response) {
        var i = 1;
        var res = '' +
            '<table class="table table-bordered table-font text-center">' +
                '<tr class="active">' +
                    '<td>Name</td>' +
                    '<td>Training Datasource</td>' +
                    '<td>Status</td>' +
                    '<td>Endpoint Status</td>' +                    
                    '<td>Last Updated</td>' +
                    '<td>Action</td>' +
                '</tr>' +
            '<span class="hide">' + i + '</span>';

        for (var key in response.data) {
            i = i + 1;          
          
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
                '<td class="name">' + checkVariable(response.data[key].Name) +
                '</td>' +
                '<td>' + checkVariable(response.data[key].TrainingDataSourceName) +
                '</td>' +
                '<td class="' + statusTextColor(response.data[key].Status) + '">' + response.data[key].Status + '</td>' +
                '<td class="status-endpoint ' + colorTextEndpointStatus + '">' + endpointStatus + '</td>' +               
                '<td>' + timeConverter(response.data[key].LastUpdatedAt) + '</td>' +
                '<td style="width:140px" nowrap>' +
                    '<a class="btn btn-warning btn-sm btn-list delete-endpoint ' + endpointDisabled + '" href="#modal"' +
                        'id="info_' + i + '" data-model-id="' + response.data[key].MLModelId + '">' +
                        '<span class="glyphicon glyphicon-remove-circle"></span>' +
                    '</a>&nbsp;' +
                    '<a class="btn btn-info btn-sm btn-list datasource-info" href="#modal"' +
                        'data-toggle="modal" id="info_' + i + '" data-source-id="' + response.data[key].MLModelId + '">' +
                        '<span class="glyphicon glyphicon-info-sign"></span>' +
                    '</a>&nbsp;' +
                    '<a class="btn btn-danger btn-sm btn-list delete" href="#" data-delete-id="' + response.data[key].MLModelId + '">\n' +
                        '<span class="glyphicon glyphicon-trash"></span>' +
                    '</a>' +
                '</td>' +
            '</tr>' +
            '<span class="hide">' + i + '</span>';
        };

        res += '</table>';

        $('.container-describeMLModels').html(res);
        
        $('.container-describeMLModels').addClass('loaded');
    });
};