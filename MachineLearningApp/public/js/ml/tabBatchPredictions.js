$(document).ready(function() {

    $("[data-toggle='tooltip']").tooltip();

    if (window.location.hash == '#describeBatchPredictions') {
        buttonCreateBathPrediction();
        listBatchPrediction();
    }

    $('.create-bath-predictios-form').on("submit", function(e) {
        e.preventDefault(); 
        $(".modalCreateBatchPrediction").modal('toggle');
        $('.container-describeBatchPredictions').html('<br><div class="row" id="modal_row"><div align="center" class="loader col-md-2 col-md-offset-5" id="loader"></div></div>');
           
        $.ajax({
            url: '/ml/upload-batch-source',
            method: 'POST',
            data: new FormData($(".create-bath-predictios-form")[0]),
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {               
                listBatchPrediction();               
            }           
        });
    });

    $(document).on("click", ".btn-create-bath-description", function() {    
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
                        '<td>Name</td>' +
                        '<td>Status</td>' +
                        '<td>Count</td>' +
                        '<td>Last Updated</td>' +
                        '<td>Action</td>' +
                    '</tr>' +
                    '<span class="hide">'+ i +'</span>';
                for (var key in response.data) {
                    i = i+1;
                    var date = response.data[key].LastUpdatedAt.replace('T', '  ');
                    fileName = response.data[key].InputDataLocationS3.split('/').reverse()[0];
                    date = date.substring(0, date.indexOf('+'));
                    path = response.data[key].OutputUri + 'batch-prediction/result/' +  response.data[key].BatchPredictionId + '-' + fileName + '.gz';
                    if (response.data[key].Status == 'COMPLETED') {
                        classText = 'text-success';
                    }

                    res +=
                        '<tr>' +                         
                            '<td class="name">' + response.data[key].Name + '</td>' +
                            '<td class="' + classText + '">' + response.data[key].Status + '</td>' +                          
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
                                '<a class="btn btn-success btn-sm btn-list download" href="#" data-download-path="' + path +'" >' +
                                    '<span class="glyphicon glyphicon-cloud-download"></span></a>&nbsp;' +
                                '<a class="btn btn-danger btn-sm btn-list delete" href="#" data-delete-id="' +
                                    response.data[key].BatchPredictionId + '"><span class="glyphicon glyphicon-trash"></span></a>' +
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

