$(document).ready(function() {
    // ML: add hash tab to url
    $('.ml-tabs').on('click', 'a', function (e) {
        e.preventDefault();
        window.location.hash = $(this).attr('href');
        $(this).tab('show');
    });
    if(window.location.hash){
       $('.ml-tabs').find('a[href="'+window.location.hash+'"]').tab('show');
    }


    // tooltip from upload button
    $("[data-toggle='tooltip']").tooltip();

    // upload button without submit
    $('#input-file').change(function() {
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
        $(selector).append('<div class="alert alert-success upload-message-s3">' +
            '<ul><li><strong>Success! </strong>' +
            str + '</li></ul></div>').show('slow').hide(4000);
    }

    function errorS3(selector) {
        $(selector).append('<div class="alert alert-danger upload-message-s3">' +
            '<ul><li><strong>Error! File is not loaded to S3!</strong>' +
            '</li></ul></div>').show('slow').hide(4000);
    }

    $(document).on('click', '.btn-delete', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        $.ajax({
            url: '/s3/delete',
            method: 'post',
            data: {
                name: $(this).attr('id')
            },
            success: function(data) {
                console.log(data);
                if (data.success) {

                    $(e.target).closest('tr').hide("fast");
                }
                success('.notification-s3', 'File delete!');
            }
        });
    });

    $(document).on('click', '.download', function (e) {
       var url = encodeURI('/s3/download-from-s3?name=' + $(this).data('download-path'));
       e.preventDefault();
       $.get('/s3/file-exists', {
           name: encodeURI($(this).data('download-path')) }, function (response) {
            if (response.data == true ) {
                window.location = url;
            } else {
                $.jGrowl('File not exists', {
                    theme: 'jgrowl-danger'
                });
            }

       });
    });

    //upload file to s3 bucket using ajax
    $('.form-upload').on("submit", function(e) {
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
            success: function(data) {
                getListS3();
                success('.notification-s3', 'File uploaded to S3!');
            },
            error: function() {
                errorS3('.notification-s3');
            },
        });
    });

    // update list s3
    function getListS3() {
        $.ajax({
            url: '/s3/list',
            method: 'GET',
            success: function(data) {
                $('.s3-pagination').html($(data).find('div.pagination-list'));
                $('.s3-table').html($(data).find('table'));
            }
        });
    }

    //modal window ML
    $(document).on("click", '.datasource-info', function(event) {
        var datasourceId = $(event.target).closest('a').data('source-id');
        var tab = $(event.target).closest('div.container').find('div.row').find('div.tabs').find('div.ML-tabs').find('ul.nav-tabs').find('li.active').find('a').text();

        var temp = $(event.target).closest('a').attr('href');

        var data = {
            Name: "",
            Message: ""
        };

        var url;

        switch (tab) {
            case 'Data Source':
                url = '/ml/getdatasource/';
                break;
            case 'Models':
                url = '/ml/getmlmodel/';
                break;
            case 'Evaluations':
                url = '/ml/getevaluation/';
                break;
            case 'Batch Predictions':
                url = '/ml/getbatchprediction/';
                break;

        }

        $.get(url + datasourceId, function(response) {
            switch (tab) {
                case 'Data Source':
                    data.Name = response.data[0];
                    data.Message = response.data[3];
                    data.Size = response.data[1] + ' Bytes';
                    data.NumberOfFiles = response.data[2] + ' Files';
                    data.Location = response.data[4];
                    data.DataSourceId = response.data[5];
                    data.DatasetId = response.data[6];
                    break;
                case 'Models':
                    data.Name = response.data[0];
                    data.Message = response.data[3];
                    data.Size = response.data[1] + ' Bytes';
                    data.DataLocation = response.data[2];
                    data.ModelId = response.data[4];
                    data.TrainingData = response.data[5];
                    break;
                case 'Evaluations':
                    data.Name = response.data[0];
                    data.Message = response.data[3];
                    data.ComputeTime = response.data[1];
                    data.DataLocation = response.data[2];
                    data.EvaluationId = response.data[4];
                    data.ModelId = response.data[5];
                    data.EvaluationData = response.data[6];
                    break;
                case 'Batch Predictions':
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
    $(document).on('click', '.delete', function(event) {
        var target = $(event.target).closest('div.container').find('div.row').find('div.tabs').find('div.ML-tabs').find('ul.nav-tabs').find('li.active').find('a').text();

        $(event.target).closest('tr').fadeOut();

        function deleteObject(dataSourceIdVar, url) {
            var datasourceId = $(event.target).closest('a').data('delete-id');

            if (target == dataSourceIdVar) {
                $.get(url + datasourceId, function(response) {
                    if (response.deleted !== 'Ok') {
                        $.jGrowl('An error occurred during delete process', {
                            theme: 'jgrowl-danger'
                        });
                    } else {
                        $.jGrowl('Success', {
                            theme: 'jgrowl-success'
                        });

                    }
                });
            }
        }

        switch (target) {
            case 'Data Source':
                deleteObject('Data Source', '/ml/delete-datasource/');
                break;
            case 'Models':
                deleteObject('Models', '/ml/delete-ml-model/');
                break;
            case 'Evaluations':
                deleteObject('Evaluations', '/ml/delete-evaluation/');
                break;
            case 'Batch Predictions':
                deleteObject('Batch Predictions', '/ml/delete-batch-prediction/');
                break;
        }

        event.preventDefault();
    });

    //loading data
    $('.modal-1').on('hidden.bs.modal', function() {
        $('.modal-body-1').html('<div class="row" id="modal_row"><div align="center" class="loader col-md-2 col-md-offset-5" id="loader"></div></div>');
    });

});

