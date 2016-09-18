$(document).ready(function() {

    if (window.location.hash == '#describeMLModels') {
        listMLModel();
    }

  
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
                $(".create-mlmodel-form").toggle();
                $(".container-describeMLModels").toggle();
                listMLModel();
                console.log(data);
            },
            error: function() {},
        });
    });

    $(document).on('blur', '.form-control', function (e) {
        var id = e.target.id;
        var val = e.target.value;
        $(this).closest('div').find('span').addClass('hide');

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
            $(this).closest('form').find('button').addClass('disabled');
        } else {
            $(this).closest('form').find('button').removeClass('disabled');
        }


    });


    $(document).on("click", ".btn-create-mlmodel", function() {
        $('.create-mlmodel-form').toggle();
        $(".container-describeMLModels").toggle();

        $.get("/ml/select-data-source", function(response) {
            var result='';
            
            for (var key in response.data) {          
                result += '<option value="' + response.data[key].DataSourceId + '">' + response.data[key].Name + '</option>';             
            };
            $('#SelectDataSource').html(result);
        });
    });

    $(document).on("click", '#describeMLModelsContent', function () {
        var button = '<button class="btn btn-primary btn-create-mlmodel pull-right">Create ML Mode</button>'
        $('#ml-button-create').html(button);
        if(!$('.container-describeMLModels').hasClass('loaded')) {
            listMLModel();
        }
    });

    //    //loading data
    //    $('#describeMLModelsContent').on('click', function() {
    //        $('.container-describeMLModels').html('<br><div class="row" id="modal_row"><div align="center" class="loader col-md-2 col-md-offset-5" id="loader"></div></div>');
    //    });

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

    function listMLModel() {

        $('.container-describeMLModels').html('<br><div class="" id="modal_row"><div align="center" class="loader col-md-2 col-md-offset-5" id="loader"></div></div>');
//        var button = '<button class="btn btn-primary btn-create-mlmodel pull-right">Create ML Mode</button>'
//        $('#ml-button-create').html(button);

        $.get("/ml/describe-ml-model", function(response) {
            var i = 1;
            var res = '' +
                '<table class="table table-bordered table-font text-center">' +
                '<tr class="active">' +
                '<td>MLModelId</td>' +
                '<td>Name</td>' +
                '<td>Status</td>' +
                '<td>EndpointStatus</td>' +
                '<td>TrainingDataSourceId</td>' +
                '<td>MLModelType</td>' +
                '<td>Last Updated</td>' +
                '<td>&nbsp;</td>' +
                '</tr>' +
                '<span class="hide">' + i + '</span>';
            for (var key in response.data) {
                i = i + 1;
                date = response.data[key].LastUpdatedAt.replace('T', '  ');
                date = date.substring(0, date.indexOf('+'));
                if (response.data[key].EndpointInfo.EndpointStatus == 'READY') {
                    endpointDisabled = '';
                } else {
                    endpointDisabled = 'disabled';
                };
                res += '' +
                    '<tr>' +
                    '<td>' + response.data[key].MLModelId + '</td>' +
                    '<td>';
                if (response.data[key].Name !== undefined) {
                    res += response.data[key].Name;
                }
                res += '' +
                    '</td>' +
                    '<td>' + response.data[key].Status + '</td>' +
                    '<td class="status-endpoint">' + response.data[key].EndpointInfo.EndpointStatus + '</td>' +
                    '<td>' + response.data[key].TrainingDataSourceId + '</td>' +
                    '<td>' + response.data[key].MLModelType + '</td>' +
                    '<td>' + date + '</td>' +
                    '<td style="width:140px" nowrap>' +
                    '<a class="btn btn-warning btn-sm btn-list delete-endpoint ' + endpointDisabled + '" href="#modal"' +
                    'id="info_' + i + '" data-model-id="' + response.data[key].MLModelId + '">' +
                        '<span class="glyphicon glyphicon glyphicon-minus"></span></a>&nbsp;' +
                    '<a class="btn btn-info btn-sm btn-list datasource-info" href="#modal"' +
                    'data-toggle="modal" id="info_' + i + '" data-source-id="' + response.data[key].MLModelId + '">' +
                        '<span class="glyphicon glyphicon-info-sign"></span></a>&nbsp;' +
                    '<a class="btn btn-danger btn-sm btn-list delete" href="#" data-delete-id="' + response.data[key].MLModelId + '">\n' +
                        '<span class="glyphicon glyphicon-trash"></span></a>' +
                    '</td>' +
                    '</tr>' +
                    '<span class="hide">' + i + '</span>';
            }
            res += '</table>';

            $('.container-describeMLModels').html(res);
            $('.container-describeMLModels').addClass('loaded');

        });
    };
});