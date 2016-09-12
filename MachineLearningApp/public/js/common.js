$(document).ready(function () {
    // tooltip from upload button
    $("[data-toggle='tooltip']").tooltip();

    // upload button without submit
    $('#input-file').change(function () {
        $('.form-upload').submit();
    });

    // upload show/hide message
    $(".upload-message").show().delay(1500).fadeOut(1000);

    // delete row from s3 table using ajax
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function success(selector, str) {
        $(selector).append('<div class="alert alert-success upload-message-s3">'
            + '<ul><li><strong>Success! </strong>'
            + str + '</li></ul></div>').show('slow').hide(4000);
    }

    function errorS3(selector) {
        $(selector).append('<div class="alert alert-danger upload-message-s3">'
            + '<ul><li><strong>Error! File is not loaded to S3!</strong>'
            + '</li></ul></div>').show('slow').hide(4000);

    }

    $(document).on('click', '.btn-delete', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        $.ajax({
            url: '/s3/delete',
            method: 'post',
            data: {name: $(this).attr('id')},
            success: function (data) {
                console.log(data);
                if (data.success) {

                    $(e.target).closest('tr').hide("fast");
                }
                success('.notification-s3', 'File delete!');
            }
        });
    });

    //upload file to s3 bucket using ajax
    $('.form-upload').on("submit", function (e) {
        console.log($(".form-upload"));
        e.preventDefault();
        $('.preload-s3').show('fast').delay(4000).fadeOut(400);
        $.ajax({
            url: '/s3/upload',
            method: 'POST',
            data: new FormData($(".form-upload")[0]),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                getListS3();
                successS3('.notification-s3', 'File uploaded to S3!');
            },
            error: function () {
                errorS3('.notification-s3');
            },
        });
    });

    // update list s3
    function getListS3() {
        $.ajax({
            url: '/s3/list',
            method: 'GET',
            success: function (data) {
                $('.s3-pagination').html($(data).find('div.pagination-list'));
                $('.s3-table').html($(data).find('table'));
            }
        });
    }

    // prediction: get id model
    $.get("/ml/select-ml-model", function (response) {
        var result;

        for (var key in response.data) {

            result += '<option value="' + response.data[key].MLModelId + '">' + response.data[key].Name + '</option>';
        }
        $('#ml_model_id').html(result);
    });

    // prediction: send form
    $('.form-prediction').on('submit', function (e) {
        e.preventDefault();

        addPredictionProgress();

        $.ajaxSetup({
            headers: {'X-XSRF-Token': $('meta[name="_token"]').attr('content')}
        });

        var formData = $(this).serialize();
        var formAction = $(this).attr('action');
        var formMethod = $(this).attr('method');

        function formPredict() {
            $.ajax({
                type: formMethod,
                url: formAction,
                data: formData,
                cache: false,
                success: function (data) {
                    if (data == 'Updating') {
                        setTimeout(formPredict(), 3000);
                    }
                    else {
                        removePredictionProgress()
                        $('.block-prediction').html('<h1 class="text-center">Done</h1> ' + data);
                    }
                },
                error: function () {
                    setTimeout(formPredict(), 3000);
                }
            });
        }

        formPredict();
    });

    // prediction: form processing style
    function addPredictionProgress() {
        $('.spinner-prediction').show('slow');
        $('.form-prediction').addClass('form-pred-disabled');
        $('.block-prediction').addClass('block-pred-disabled');
    }

    function removePredictionProgress() {
        $('.spinner-prediction').hide('slow');
        $('.form-prediction').removeClass('form-pred-disabled');
        $('.block-prediction').removeClass('block-pred-disabled');
    }


    // prediction: send form
    $('.form-prediction').on('submit', function(e) {
        e.preventDefault();

        addPredictionProgress();

        $.ajaxSetup({
            headers: { 'X-XSRF-Token': $('meta[name="_token"]').attr('content') }
        });

        var formData   = $(this).serialize();
        var formAction = $(this).attr('action');
        var formMethod = $(this).attr('method');

        function formPredict() {
            $.ajax({
                type    : formMethod,
                url     : formAction,
                data    : formData,
                cache   : false,
                success : function(data) {
                              if (data == 'Updating') {
                                  setTimeout(formPredict(), 3000);
                              }
                              else {
                                removePredictionProgress()
                                $('.block-prediction .prediction-data').html('<div class="pred-data">'
                                    + '<h1 class="text-center">Done</h1> '
                                    + data + "</div>");
                              }
                          },
                error   : function() {
                              setTimeout(formPredict(), 3000);
                          }
            });
        }

        formPredict();
    });

    // prediction: form processing style
    $('.spinner-prediction').hide();
    function addPredictionProgress() {
        // $('.spinner-prediction').fadeIn('slow');
        $('.block-sp').append('<i class="spinner-prediction spinner-disabled fa fa-spinner fa-spin"></i>').fadeIn('slow');
        $('.pred-data').remove();
        $('.form-prediction').addClass('form-pred-disabled');
        $('.block-prediction').addClass('block-pred-disabled');
    }

    function removePredictionProgress() {
        // $('.spinner-prediction').fadeOut('slow');
        $('.block-sp').append('<i class="spinner-prediction spinner-disabled fa fa-spinner fa-spin"></i>').fadeOut('slow');
        $('.form-prediction').removeClass('form-pred-disabled');
        $('.block-prediction').removeClass('block-pred-disabled');
    }

//modal window ML
    $(document).on("click", '.datasource-info', function (event) {
        var datasourceId = $(event.target).closest('tr').find('td:first').text();

        var data = {
            Name: "",
            Message: ""
        };

        var url;

        switch ($(event.target).closest('table').find('tr:first').find('td:first').text()) {
            case 'DataSourceId':
                url = '/ml/getdatasource/';
                break;
            case 'MLModelId':
                url = '/ml/getmlmodel/';
                break;
            case 'EvaluationId':
                url = '/ml/getevaluation/';
                break;
            case 'BatchPredictionId':
                url = '/ml/getbatchprediction/';
                break;

            default:
                break;
        }

        $.get(url + datasourceId, function (response) {
            switch ($(event.target).closest('table').find('tr:first').find('td:first').text()) {
                case 'DataSourceId':
                    data.Name = response.data[0];
                    data.Message = response.data[3];
                    data.Size = response.data[1] + ' Bytes';
                    data.NumberOfFiles = response.data[2] + ' Files';
                    data.Location = response.data[4];
                    data.DataSourceId = response.data[5];
                    data.DatasetId = response.data[6];
                    break;
                case 'MLModelId':
                    data.Name = response.data[0];
                    data.Message = response.data[3];
                    data.Size = response.data[1] + ' Bytes';
                    data.DataLocation = response.data[2];
                    data.ModelId = response.data[4];
                    data.TrainingData = response.data[5];
                    break;
                case 'EvaluationId':
                    data.Name = response.data[0];
                    data.Message = response.data[3];
                    data.ComputeTime = response.data[1];
                    data.DataLocation = response.data[2];
                    data.EvaluationId = response.data[4];
                    data.ModelId = response.data[5];
                    data.EvaluationData = response.data[6];
                    break;
                case 'BatchPredictionId':
                    data.Name = response.data[0];
                    data.Message = response.data[3];
                    data.ComputeTime = response.data[1];
                    data.DataLocation = response.data[2];
                    data.BatchPredictionId = response.data[4];
                    data.BatchPredictionDataSourceId = response.data[5];
                    data.ModelId = response.data[6];
                    break;
            }

            display(data);
        });

        function display(data) {
            var thead = '<thead>';
            var tbody = '<tbody>';

            for (var key in data) {
                if (key === 'Name') {
                    thead += '' +
                        '<tr>' +
                        '<th>Name</th>' +
                        '<th>' + data.Name + '</th>' +
                        '</tr>';
                } else {
                    if (typeof data[key] !== 'undefined') {
                        tbody += '' +
                            '<tr>' +
                            '<td>' + key + '</td>' +
                            '<td>' + data[key] + '</td>' +
                            '</tr>';
                    }
                }
            }

            thead += '</thead>';
            tbody += '</tbody';

            var result = '<table class="table table-condensed">' + thead + tbody + '</table>';

            $('#result_info').html(result);
        }

        event.preventDefault();
    });

    // Delete Ajax
    $(document).on('click', '.delete', function (event) {
        var target = $(event.target).closest('table').find('tr:first').find('td:first').text();

        $(event.target).closest('tr').fadeOut();

        function deleteObject(dataSourceIdVar, url) {
            var datasourceId = $(event.target).closest('tr').find('td:first').text();

            if (target == dataSourceIdVar) {
                $.get(url + datasourceId, function (response) {
                    if (response.deleted !== 'Ok') {
                        $.jGrowl('An error occurred during delete process', {theme: 'jgrowl-danger'});
                    }
                });
            }
        }

        switch (target) {
            case 'DataSourceId':
                deleteObject('DataSourceId', '/ml/delete-datasource/');
                break;
            case 'MLModelId':
                deleteObject('MLModelId', '/ml/delete-ml-model/');
                break;
            case 'EvaluationId':
                deleteObject('EvaluationId', '/ml/delete-evaluation/');
                break;
            case 'BatchPredictionId':
                deleteObject('BatchPredictionId', '/ml/delete-batch-prediction/');
                break;
        }

        event.preventDefault();
    });

        //loading data
        $('.modal').on('hidden.bs.modal', function() {
            $('.modal-body').html('<div class="row" id="modal_row"><div align="center" class="loader col-md-2 col-md-offset-5" id="loader"></div></div>');
        });

});
