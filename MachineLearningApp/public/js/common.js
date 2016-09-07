$(document).ready(function () {
    // tooltip from upload button
    $("[data-toggle='tooltip']").tooltip();

    // upload button without submit
    $('#input-file').change(function () {
        $('.form-upload').submit();
    });

    //ml hide/show form create
    $('.btn-create-mlmodel').click(function () {
        $('.create-mlmodel').toggle();
        $(".container-describeMLModels").toggle();
    });

    $(".btn-create-bath-description").click(function () {
        $(".create-bath-description").toggle();
        $(".container-describeBatchPredictions").toggle();
    });

    $(".btn-create-evaluations").click(function () {
        $(".create-evaluations").toggle();
        $(".container-describeEvaluations").toggle();
    });

    $(".btn-create-datasource").click(function () {
        $(".create-datasource").toggle();
        $(".container-describeDataSources").toggle();
    });

    // upload show/hide message
    $(".upload-message").show().delay(1500).fadeOut(1000);

    // delete row from s3 table using ajax
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '.btn-delete', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        $.ajax({
            url: url,
            method: 'GET',
            success: function (data) {
                if (data.success) {
                    $(e.target).closest('tr').hide("fast");
                }
                $('.notification-s3').append('<div class="alert alert-success upload-message-s3">'
                    + '<ul><li><strong>Success!</strong>'
                    + '   File delete!</li></ul></div>').show('slow').hide(4000);
            }
        });
    });

    //upload file to s3 bucket using ajax
    $('.form-upload').on("submit", function (e) {
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
                $('.notification-s3').append('<div class="alert alert-success upload-message-s3">'
                    + '<ul><li><strong>Success!</strong>'
                    + '   File successfully uploaded to S3!</li></ul></div>').show('slow').hide(4000);
            },
            error: function () {
                $('.notification-s3').append('<div class="alert alert-danger upload-message-s3">'
                    + '<ul><li><strong>Error! File no upload to S3!</strong>'
                    + '</li></ul></div>').show('slow').hide(4000);
            },
        });
    });

    // update list s3
    function getListS3() {
        $.ajax({
            url: '/s3/list',
            method: 'GET',
            success: function (data) {
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