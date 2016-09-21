$(document).ready(function() {
    $("[data-toggle='tooltip']").tooltip();

    if (window.location.hash == '#describeBatchPredictions') {
        buttonCreateBathPrediction();
        listBatchPrediction();
    }

    // upload show/hide message
    $(".upload-message").show().delay(1500).fadeOut(1000);

    //upload file to s3 bucket using ajax
    $('.create-bath-predictios-form').on("submit", function(e) {
        console.log($(".create-bath-predictios-form"));

        //loading data       
      // $(".create-bath-predictios-form").toggle();
      // $(".container-describeBatchPredictions").toggle();
        $(".modalCreateBatchPrediction").modal('toggle');
        $('.container-describeBatchPredictions').html('<br><div class="row" id="modal_row"><div align="center" class="loader col-md-2 col-md-offset-5" id="loader"></div></div>');
        e.preventDefault();    
        $.ajax({
            url: '/ml/upload-batch-source',
            method: 'POST',
            data: new FormData($(".create-bath-predictios-form")[0]),
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                console.log(response.data);
               
                listBatchPrediction();               
            },
            error: function() {},
        });
    });


    function successS3(selector, str) {
        $(selector).append('<div class="alert alert-success upload-message-s3">' +
            '<ul><li><strong>Success! </strong>' +
            str + '</li></ul></div>').show('slow').hide(4000);
    }

    function errorS3(selector) {
        $(selector).append('<div class="alert alert-danger upload-message-s3">' +
            '<ul><li><strong>Error! File is not loaded to S3!</strong>' +
            '</li></ul></div>').show('slow').hide(4000);

    }

    $(document).on("click", ".btn-create-bath-description", function() {
     //   $(".create-bath-predictios-form").toggle();
      //  $(".container-describeBatchPredictions").toggle();
        $('#SelectBathMLModel').addClass('remove-arrow');
        var load = '<div class="loader-im" style="width: 28px; height: 28px; float: left;right: 4px;top: 30px;position: absolute;">' +
            '<div align="center" class="loader-select" id="loader"></div></div>';
        $('.create-bath-predictios-form').find('.select-load').append(load);
        $.get("/ml/select-ml-model", function(response) {
            var result;

            for (var key in response.data) {
                result += '<option value="' + response.data[key].MLModelId + '">' + response.data[key].Name + '</option>';
            }            
            $('#SelectBathMLModel').html(result);
            $('#SelectBathMLModel + .loader-im').remove();
            $('#SelectBathMLModel').removeClass('remove-arrow');
        });

        $.get("/ml/select-data-source", function(response) {
            var result;

            for (var key in response.data) {

                result += '<option value="' + response.data[key].DataSourceId + '">' + response.data[key].Name + '</option>';
            }
            $('#SelectBathDataSource').html(result);
        });
    });

    $(document).on("click", '#describeBatchPredictionsContent', function () {
        buttonCreateBathPrediction();
        if(!$('.container-describeBatchPredictions').hasClass('loaded')) {
            listBatchPrediction();
        }
    });


    function buttonCreateBathPrediction() {
        var button = '<button class="btn btn-primary btn-create-bath-description pull-right" data-toggle="modal" ' +
        'data-target="#modalCreateBatchPrediction">Create batch prediction</button>';
        $('#ml-button-create').html(button);
    }

    function listBatchPrediction() {
        $('.container-describeBatchPredictions').html('<br><div class="" id="modal_row"><div align="center" class="loader col-md-2 col-md-offset-5" id="loader"></div></div>');

        $.get("/ml/describe-batch-prediction", function(response) {
            var i = 1;
            var res = '' +
                '<table class="table table-bordered table-font text-center">' +
                '<tr class="active">' +
                //'<td>BatchPredictionId</td>' +
                '<td>Name</td>' +
                '<td>Status</td>' +
                //'<td>MLModelId</td>' +
                //'<td>Batch Prediction DataSource ID</td>' +
                //'<td>Output Uri</td>' +
                '<td>Count</td>' +
                '<td>Last Updated</td>' +
                '<td>&nbsp;</td>' +
                '</tr>' +
                '<span class="hide">'+ i +'</span>';
                for (var key in response.data) {
                    i = i+1;
                    var date = response.data[key].LastUpdatedAt.replace('T', '  ');
                    fileName = response.data[key].InputDataLocationS3.split('/').reverse()[0];
                    date = date.substring(0, date.indexOf('+'));
                    path = response.data[key].OutputUri + 'batch-prediction/result/' +  response.data[key].BatchPredictionId + '-' + fileName + '.gz';
                    res +=
                        '<tr>' +
                           // '<td>' + response.data[key].BatchPredictionId + '</td>' +
                            '<td class="name">' + response.data[key].Name + '</td>' +
                            '<td>' + response.data[key].Status + '</td>' +
                            //'<td>' + response.data[key].MLModelId + '</td>' +
                            //'<td>' + response.data[key].BatchPredictionDataSourceId + '</td>' +
                            //'<td>' + response.data[key].OutputUri + '</td>' +
                            '<td>';
                                if (response.data[key].TotalRecordCount !== undefined) {
                                    res += response.data[key].TotalRecordCount;
                                };
                    res +=  '</td>' +
                            '<td>' + date + '</td>' +
                            '<td style="width:140px" nowrap>' +
                                '<a class="btn btn-info btn-sm btn-list datasource-info" href="#modal"' +
                                   'data-toggle="modal" id="info_' + i +'" data-source-id="' + response.data[key].BatchPredictionId + '">' +
                                    '<span class="glyphicon glyphicon-info-sign"></span></a>&nbsp;' +
                                '<a class="btn btn-success btn-sm btn-list download" href="#" data-download-path="' + path +'" ><span class="glyphicon glyphicon-cloud-download"></span></a>&nbsp;' +
                                '<a class="btn btn-danger btn-sm btn-list delete" href="#" data-delete-id="' + response.data[key].BatchPredictionId + '"><span class="glyphicon glyphicon-trash"></span></a>' +

                            '</td>' +
                        '</tr>' +

                    '<span class="hide">' + i + '</span>';
            }
            res += '</table>';

            $('.container-describeBatchPredictions').html(res);
            $('.container-describeBatchPredictions').addClass('loaded');
        });
    }
});

