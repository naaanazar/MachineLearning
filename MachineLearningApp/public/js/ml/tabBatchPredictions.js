$(document).ready(function() {
    if (window.location.hash == '#describeBatchPredictions') {
        buttonCreate('btn-create-bath-description', '#ml-button-create', 'Create batch prediction', '#modalCreateBatchPrediction');
        listBatchPrediction('ok');
        $(".ml-button-block").hide().fadeOut();
        $(".ml-table").fadeIn();
    }

    $("[data-toggle='tooltip']").tooltip();

    $('.create-bath-predictios-form').on("submit", function(e) {
        e.preventDefault();
        $(".modalCreateBatchPrediction").modal('toggle');
        showLoader('.container-describeBatchPredictions');
        run_waitMe('#modal-bp-id');

        $.ajax({
            url: '/ml/upload-batch-source',
            method: 'POST',
            data: new FormData($(".create-bath-predictios-form")[0]),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                listBatchPrediction(data);
            }
        });
    });

    $(document).on("click", ".btn-create-bath-description", function() {
        $('.create-bath-predictios-form')[0].reset();
        selectName('/ml/select-ml-model?Obj=ml', '#SelectBathMLModel', '.create-bath-predictios-form');
    });

    $(document).on("click", '#describeBatchPredictionsContent', function () {
        buttonCreate('btn-create-bath-description', '#ml-button-create', 'Create batch prediction', '#modalCreateBatchPrediction');

        if(!$('.container-describeBatchPredictions').hasClass('loaded')) {
            listBatchPrediction('ok');
        }
    });  
    
});

function listBatchPrediction(status)
{   
    showLoader('.container-describeBatchPredictions');
    statusAction(status);

    $.get("/ml/describe-batch-prediction?Obj=ml", function(response) {
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
            var path = getPathBathPredictionResult(response.data[key].InputDataLocationS3, response.data[key].OutputUri, response.data[key].BatchPredictionId);
            res +=
            '<tr>' +
                '<td class="name">' + checkVariable(response.data[key].Name) +
                '</td>' +
                '<td class="' + statusTextColor(response.data[key].Status) + '">' + response.data[key].Status + '</td>' +
                '<td>' + checkVariable(response.data[key].TotalRecordCount) +
                '</td>' +
                '<td>' + timeConverter(response.data[key].LastUpdatedAt) + '</td>' +
                '<td style="width:140px" nowrap>' +
                    '<a class="btn btn-info btn-sm btn-list datasource-info" href="#modal"' +
                       'data-toggle="modal" id="info_' + i +'" data-source-id="' + response.data[key].BatchPredictionId + '">' +
                        '<span class="glyphicon glyphicon-info-sign"></span>' +
                    '</a>&nbsp;' +
                    '<a class="btn btn-success btn-sm btn-list download" href="#" data-download-path="' + path +'" >' +
                        '<span class="glyphicon glyphicon-cloud-download"></span>' +
                    '</a>&nbsp;' +
                    '<a class="btn btn-danger btn-sm btn-list delete" href="#" data-delete-id="' +
                        response.data[key].BatchPredictionId + '"><span class="glyphicon glyphicon-trash"></span>' +
                    '</a>' +
                '</td>' +
            '</tr>' +
            '<span class="hide">' + i + '</span>';
        };

        res += '</table>';

        $('.container-describeBatchPredictions').html(res);
      
        $('.container-describeBatchPredictions').addClass('loaded');
    });
};

function getPathBathPredictionResult(inputDataLocationS3, outputUri, batchPredictionId) {
    fileName = inputDataLocationS3.split('/').reverse()[0];
    path = outputUri + 'batch-prediction/result/' +  batchPredictionId + '-' + fileName + '.gz';

    return path;
};

