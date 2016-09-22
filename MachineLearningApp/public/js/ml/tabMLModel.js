$(document).ready(function() {

    if (window.location.hash == '#describeMLModels') {
        buttonCreateModels();
        listMLModel();
    };
  
    $(document).on('mouseenter', '.delete-endpoint', function (e) {
        e.preventDefault();
        $.jGrowl('delete RealtimeEndpoint', {
            theme: 'jgrowl-notification'
        });
    });

    $(document).on('blur', '.form-control', function (e) {
        var id = e.target.id;
        var val = e.target.value;

        switch (id) {
            case 'MLModelName':
                var rv_name = /^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$/;

                if (val.length > 2 && val != '' && rv_name.test(val)) {
                    $(this).removeClass('error').addClass('not_error');
                    $(this).closest('div').removeClass('has-error');
                    $(this).closest('div').addClass('has-success has-feedback');
                    $(this).closest('div').find('span').removeClass('hide');

                }
                else {
                    $(this).removeClass('not_error').addClass('error');
                    $(this).closest('div').addClass('has-error has-feedback');
                    $(this).closest('div').find('span').addClass('hide');
                }
                break;

        }
        if ($(this).closest('form').find('div.has-error').hasClass('has-error') == true) {
            $(this).closest('form').find('input#success-button-modal-ml').attr('disabled', 'disabled');
        } else {
            $(this).closest('form').find('input#success-button-modal-ml').removeAttr('disabled');
        }


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
        $('#SelectDataSource').addClass('remove-arrow');
        var load = '<div class="loader-im" style="width: 28px; height: 28px; float: left;right: 4px;top: 30px;position: absolute;">' +
                '<div align="center" class="loader-select" id="loader"></div></div>';       
        $('.create-mlmodel-form').find('.select-load').append(load);

        $.get("/ml/select-data-source", function(response) {
            var result='';
            
            for (var key in response.data) {          
                result += '<option value="' + response.data[key].DataSourceId + '">' + response.data[key].Name + '</option>';             
            };

            $('#SelectDataSource').html(result);
            $('#SelectDataSource + .loader-im').remove();
            $('#SelectDataSource').removeClass('remove-arrow');
        });
    });

    $(document).on("click", '#describeMLModelsContent', function () {
        buttonCreateModels();

        if(!$('.container-describeMLModels').hasClass('loaded')) {
            listMLModel();
        }
    });

    $(document).on('click', '.delete-endpoint', function (e) {
       e.preventDefault();
       console.log($(this).data('model-id'));

       $.post('/ml/delete-endpoint', {
           id: $(this).data('model-id') }, function (data) {
           console.log(data);
           $(e.target).closest("tr").find('.status-endpoint').text('NONE');
           $(e.target).closest("tr").find('.delete-endpoint').addClass('disabled');
       });
   }); 
});

function buttonCreateModels() {
        var button = '<button class="btn btn-primary btn-create-mlmodel pull-right" data-toggle="modal" ' +
        'data-target="#modalCreateModel">Create ML Mode</button>'
        $('#ml-button-create').html(button);
    };

    function listMLModel() {

        $('.container-describeMLModels').html('<br><div class="" id="modal_row"><div align="center" class="loader col-md-2 col-md-offset-5" id="loader"></div></div>');

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
                    endpointStatus = 'ENABLE';
                    colorTextEndpointStatus = 'text-danger';
                } else {
                    endpointDisabled = 'disabled btn-default';
                    endpointStatus = 'DISABLE';
                    colorTextEndpointStatus = 'text-success';
                };

                res += '' +
                '<tr>' +
                    '<td class="name">';

                if (response.data[key].Name !== undefined) {
                    res += response.data[key].Name;
                }

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