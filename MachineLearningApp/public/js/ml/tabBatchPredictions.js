$(document).ready(function() {

    $("[data-toggle='tooltip']").tooltip();

    if (window.location.hash == '#describeBatchPredictions') {
        buttonCreate('btn-create-bath-description', '#ml-button-create', 'Create batch prediction', '#modalCreateBatchPrediction');
        listBatchPrediction();
    }

    $('.create-bath-predictios-form').on("submit", function(e) {
        e.preventDefault(); 
        $(".modalCreateBatchPrediction").modal('toggle');        
           
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
        selectName('/ml/select-ml-model', '#SelectBathMLModel', '.create-bath-predictios-form');
    });

    $(document).on("click", '#describeBatchPredictionsContent', function () {
        buttonCreate('btn-create-bath-description', '#ml-button-create', 'Create batch prediction', '#modalCreateBatchPrediction');

        if(!$('.container-describeBatchPredictions').hasClass('loaded')) {
            listBatchPrediction();
        }
    });  
    
});

function listBatchPrediction()
{   
    showLoader('.container-describeBatchPredictions');

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
            fileName = response.data[key].InputDataLocationS3.split('/').reverse()[0];
            path = response.data[key].OutputUri + 'batch-prediction/result/' +  response.data[key].BatchPredictionId + '-' + fileName + '.gz';
            var date = parseDate(response.data[key].LastUpdatedAt);
            var classText = statusTextColor(response.data[key].Status);
            res +=
            '<tr>' +
                '<td class="name">' + response.data[key].Name + '</td>' +
                '<td class="' + classText + '">' + response.data[key].Status + '</td>' +
                '<td>';

            if (response.data[key].TotalRecordCount !== undefined) {
                res += response.data[key].TotalRecordCount;
            };

            res +=  '' +
                '</td>' +
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
        };

        res += '</table>';
        $('.container-describeBatchPredictions').html(res);
        $('.container-describeBatchPredictions').addClass('loaded');
    });
}

