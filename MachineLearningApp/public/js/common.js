$(document).ready(function() {
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

    function successS3(selector, str) {
        $(selector).append('<div class="alert alert-success upload-message-s3">'
            + '<ul><li><strong>Success! </strong>'
            + str  + '</li></ul></div>').show('slow').hide(4000);
    }

    function errorS3(selector) {
        $(selector).append('<div class="alert alert-danger upload-message-s3">'
            + '<ul><li><strong>Error! File is not loaded to S3!</strong>'
            + '</li></ul></div>').show('slow').hide(4000);

    }

    $(document).on('click', '.btn-delete', function(e){
        e.preventDefault();
        var url = $(this).attr('href');
        $.ajax({
            url     : url,
            method  : 'GET',
            success : function(data) {
                if(data.success) {
                    $(e.target).closest('tr').hide("fast");
                }
                successS3('.notification-s3', 'File delete!');
            }
        });
    });

    //upload file to s3 bucket using ajax
    $('.form-upload').on("submit", function(e){
        console.log($(".form-upload"));
        e.preventDefault();
        $('.preload-s3').show('fast').delay(4000).fadeOut(400);
        $.ajax({
            url         : '/s3/upload',
            method      : 'POST',
            data        : new FormData($(".form-upload")[0]),
            contentType : false,
            cache       : false,
            processData : false,
            success     : function (data) {
                getListS3();
                successS3('.notification-s3', 'File uploaded to S3!');
            },
            error       : function () {
                errorS3('.notification-s3');
            },
        });
    });

    // update list s3
    function getListS3() {
        $.ajax({
            url     : '/s3/list',
            method  : 'GET',
            success : function (data) {
                $('.s3-pagination').html($(data).find('div.pagination-list'));
                $('.s3-table').html($(data).find('table'));
            }
        });
    }
//modal window ML
    $(document).on("click", '.datasource-info', function (event) {
        var datasourceId = $(event.target).closest('tr').find('td:first').text();

        if (($(event.target).closest('table').find('tr:first').find('td:first').text()) == 'DataSourceId') {


            $.get('/ml/getdatasource/' + datasourceId, function (response) {
                var result = '<table class="table table-condensed">' +
                    '<thead>' +
                    '<tr>' +
                    '<th>' + 'NameData' + '</th>' +
                    '<th>' + 'InfoData' + '</th>' +
                    '</tr>' +
                    '</thead>' +
                    '<tbody>' +
                    '<tr>' +
                    '<td>' + 'Name' + '</td>' +
                    '<td>' + response.data[0] + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>' + 'DataSizeInBytes' + '</td>' +
                    '<td>' + response.data[1] + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>' + 'NumberOfFiles' + '</td>' +
                    '<td>' + response.data[2] + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>' + 'Message' + '</td>' +
                    '<td>' + response.data[3] + '</td>' +
                    '</tr>' +
                    '</tbody>' +
                    '</table>';

                $('#result_info').html(result);
                event.preventDefault();
            });

        } else if (($(event.target).closest('table').find('tr:first').find('td:first').text()) == 'MLModelId') {

            $.get('/ml/getmlmodel/' + datasourceId, function (response) {
                var result = '<table class="table table-condensed">' +
                    '<thead>' +
                    '<tr>' +
                    '<th>' + 'NameData' + '</th>' +
                    '<th>' + 'InfoData' + '</th>' +
                    '</tr>' +
                    '</thead>' +
                    '<tbody>' +
                    '<tr>' +
                    '<td>' + 'Name' + '</td>' +
                    '<td>' + response.data[0] + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>' + 'SizeInBytes' + '</td>' +
                    '<td>' + response.data[1] + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>' + 'InputDataLocationS3' + '</td>' +
                    '<td>' + response.data[2] + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>' + 'Message' + '</td>' +
                    '<td>' + response.data[3] + '</td>' +
                    '</tr>' +
                    '</tbody>' +
                    '</table>';

                $('#result_info').html(result);
                event.preventDefault();
            });
        } else if (($(event.target).closest('table').find('tr:first').find('td:first').text()) == 'EvaluationId') {

            $.get('/ml/getevaluation/' + datasourceId, function (response) {
                var result = '<table class="table table-condensed">' +
                    '<thead>' +
                    '<tr>' +
                    '<th>' + 'NameData' + '</th>' +
                    '<th>' + 'InfoData' + '</th>' +
                    '</tr>' +
                    '</thead>' +
                    '<tbody>' +
                    '<tr>' +
                    '<td>' + 'ComputeTime' + '</td>' +
                    '<td>' + response.data[0] + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>' + 'InputDataLocationS3' + '</td>' +
                    '<td>' + response.data[2] + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>' + 'Message' + '</td>' +
                    '<td>' + response.data[3] + '</td>' +
                    '</tr>' +
                    '</tbody>' +
                    '</table>';

                $('#result_info').html(result);
                event.preventDefault();
            });

        } else if (($(event.target).closest('table').find('tr:first').find('td:first').text()) == 'BatchPredictionId') {

            $.get('/ml/getbatchprediction/' + datasourceId, function (response) {
                var result = '<table class="table table-condensed">' +
                    '<thead>' +
                    '<tr>' +
                    '<th>' + 'NameData' + '</th>' +
                    '<th>' + 'InfoData' + '</th>' +
                    '</tr>' +
                    '</thead>' +
                    '<tbody>' +
                    '<tr>' +
                    '<td>' + 'ComputeTime' + '</td>' +
                    '<td>' + response.data[0] + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>' + 'InputDataLocationS3' + '</td>' +
                    '<td>' + response.data[2] + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>' + 'Message' + '</td>' +
                    '<td>' + response.data[3] + '</td>' +
                    '</tr>' +
                    '</tbody>' +
                    '</table>';

                $('#result_info').html(result);
                event.preventDefault();
            });

        }

    });

});