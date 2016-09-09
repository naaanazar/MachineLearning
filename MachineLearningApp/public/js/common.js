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

    function successS3(selector, str) {
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
            url: url,
            method: 'GET',
            success: function (data) {
                if (data.success) {
                    $(e.target).closest('tr').hide("fast");
                }
                successS3('.notification-s3', 'File delete!');
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

//modal window ML
    $(document).on("click", '.datasource-info', function (event) {
        var datasourceId = $(event.target).closest('tr').find('td:first').text();

        var myArray = {
            "Name": "Name",
            "DataSizeInBytes": "DataSizeInBytes",
            "NumberOfFiles": "NumberOfFiles",
            "Message": "Message",
            "SizeInBytes": "SizeInBytes",
            "InputDataLocationS3": "InputDataLocationS3",
            "DataLocationS3": "DataLocationS3",
            "DataSourceId": "DataSourceId",
            "MLModelId": "MLModelId",
            "TrainingDataSourceId": "TrainingDataSourceId",
            "EvaluationId": "EvaluationId",
            "EvaluationDataSourceId": "EvaluationDataSourceId",
            "BatchPredictionId": "BatchPredictionId",
            "BatchPredictionDataSourceId": "BatchPredictionDataSourceId"

        };

        var firstRow;
        var resDataOne;
        var secondRow;
        var resDataTwo;
        var thirdRow;
        var resDataThree;
        var fourthRow;
        var resDataFourth;
        var fifthRow;
        var resDataFifth;
        var sixthRow;
        var resDataSixth;
        var seventhRow;
        var resDataSeventh;
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
            console.log(response.data[5]);
            switch ($(event.target).closest('table').find('tr:first').find('td:first').text()) {

                case 'DataSourceId':
                    firstRow = myArray['Name'];
                    resDataOne = response.data[0];
                    secondRow = myArray['DataSizeInBytes'];
                    resDataTwo = response.data[1];
                    thirdRow = myArray['NumberOfFiles'];
                    resDataThree = response.data[2];
                    fourthRow = myArray['Message'];
                    resDataFourth = response.data[3];
                    fifthRow = myArray['DataLocationS3'];
                    resDataFifth = response.data[4];
                    sixthRow = myArray['DataSourceId'];
                    resDataSixth = response.data[5];

                    seventhRow = ' class="hide"><td>';
                    resDataSeventh = response.data[6];
                    break;
                case 'MLModelId':
                    firstRow = myArray['Name'];
                    resDataOne = response.data[0];
                    secondRow = myArray['SizeInBytes'];
                    resDataTwo = response.data[1];
                    thirdRow = myArray['InputDataLocationS3'];
                    resDataThree = response.data[2];
                    fourthRow = myArray['Message'];
                    resDataFourth = response.data[3];
                    fifthRow = myArray['MLModelId'];
                    resDataFifth = response.data[4];
                    sixthRow = myArray['TrainingDataSourceId'];
                    resDataSixth = response.data[5];

                    seventhRow = ' class="hide"><td>';
                    resDataSeventh = response.data[6];
                    break;
                case 'EvaluationId':
                    firstRow = myArray['Name'];
                    resDataOne = response.data[0];
                    secondRow = myArray['ComputeTime'];
                    resDataTwo = response.data[1];
                    thirdRow = myArray['InputDataLocationS3'];
                    resDataThree = response.data[2];
                    fourthRow = myArray['Message'];
                    resDataFourth = response.data[3];

                    fifthRow = myArray['EvaluationId'];
                    resDataFifth = response.data[4];
                    sixthRow = myArray['MLModelId'];
                    resDataSixth = response.data[5];
                    seventhRow = '><td>' + myArray['EvaluationDataSourceId'];
                    resDataSeventh = response.data[6];
                    break;
                case 'BatchPredictionId':
                    firstRow = myArray['Name'];
                    resDataOne = response.data[0];
                    secondRow = myArray['ComputeTime'];
                    resDataTwo = response.data[1];
                    thirdRow = myArray['InputDataLocationS3'];
                    resDataThree = response.data[2];
                    fourthRow = myArray['Message'];
                    resDataFourth = response.data[3];

                    fifthRow = myArray['BatchPredictionId'];
                    resDataFifth = response.data[4];
                    sixthRow = myArray['BatchPredictionDataSourceId'];
                    resDataSixth = response.data[5];
                    seventhRow = '><td>' + myArray['MLModelId'];
                    resDataSeventh = response.data[6];
                    break;
                default:
                    break;
            }
console.log(firstRow);
            var result = '<table class="table table-condensed">' +
                '<thead>' +
                '<tr>' +
                '<th>' + 'NameData' + '</th>' +
                '<th>' + 'InfoData' + '</th>' +
                '</tr>' +
                '</thead>' +
                '<tbody>' +
                '<tr>' +
                '<td>' + firstRow + '</td>' +
                '<td>' + resDataOne + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td>' + secondRow + '</td>' +
                '<td>' + resDataTwo + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td>' + thirdRow + '</td>' +
                '<td>' + resDataThree + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td>' + fourthRow + '</td>' +
                '<td>' + resDataFourth + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td>' + fifthRow + '</td>' +
                '<td>' + resDataFifth + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td>' + sixthRow + '</td>' +
                '<td>' + resDataSixth + '</td>' +
                '</tr>' +
                '<tr' + seventhRow + '</td>' +
                '<td>' + resDataSeventh + '</td>' +
                '</tr>' +
                '</tbody>' +
                '</table>';

            $('#result_info').html(result);
            event.preventDefault();
        });


    });

// Delete Ajax
    $(document).on("click", '.delete', function (event) {
        function deleteObject(dataSourceIdVar, url) {

            this.datasourceId = $(event.target).closest('tr').find('td:first').text();
            this.target = $(event.target).closest('table').find('tr:first').find('td:first').text();

            if (this.target == dataSourceIdVar) {
                $.get(url + this.datasourceId, function (response) {
                    if (response.deleted == 'Ok') {
                        $(event.target).closest('tr').fadeOut();
                    }
                });
                event.preventDefault();
            }
        }

        switch ($(event.target).closest('table').find('tr:first').find('td:first').text()) {
            case 'DataSourceId':
                var deleteVar = new deleteObject('DataSourceId', '/ml/delete-datasource/');
                break;
            case 'MLModelId':
                var deleteVar = new deleteObject('MLModelId', '/ml/delete-ml-model/');
                break;
            case 'EvaluationId':
                var deleteVar = new deleteObject('EvaluationId', '/ml/delete-evaluation/');
                break;
            case 'BatchPredictionId':
                var deleteVar = new deleteObject('BatchPredictionId', '/ml/delete-batch-prediction/');
                break;

            default:

                break;
        }


    });
});