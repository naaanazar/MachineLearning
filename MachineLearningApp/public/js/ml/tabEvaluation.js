$(document).ready(function() {

    if (window.location.hash == '#describeEvaluations') {
        buttonCreate(' btn-create-evaluations', '#ml-button-create', 'Create Evaluations', '#modalCreateEvaluation');
        listEvaluations('ok');
    }

    $('.create-evaluations-form').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: 'ml/create-evaluation',
            data: $('.create-evaluations-form').serialize(),
            success: function(data) {
                $('#EvaluationName').val('');
                $(".modalCreateEvaluation").modal('toggle');
                listEvaluations(data);
            },
            error: function() {},
        });
    });

    $(document).on("click", ".btn-create-evaluations", function() {
        selectName('/ml/select-ml-model?Obj=ml', '#SelectMLModelId', '.create-evaluations-form');
        selectName('/ml/select-data-source?Obj=ml', '#SelectEvDataSource', '.create-evaluations-form');
    });

    $(document).on("click", '#describeEvaluationsContent', function () {
        buttonCreate('btn-create-evaluations', '#ml-button-create', 'Create Evaluations', '#modalCreateEvaluation');

        if(!$('.container-describeEvaluations').hasClass('loaded')) {
            listEvaluations('ok');
        }
    });

});

function listEvaluations(status)
{
    showLoader('.container-describeEvaluations');
    statusAction(status); 

    $.get("/ml/describe-evaluations?Obj=ml", function(response) {
        var i = 1;       
        var res = '' +
        '<table class="table table-bordered table-font text-center">' +
            '<tr class="active">' +
                '<td>Name</td>' +
                '<td>Status</td>' +
                '<td>' +
                    '<div class="wrapper">' +
                        'Binary AUC' +
                        '<div class="tooltip">Area Under the Curve (AUC) - measures the ability of the model to predict a higher score for positive examples as compared to negative examples.</div>' +
                    '</div>' +
                '</td>' +
                '<td>Last Updated</td>' +
                '<td>Action</td>' +
            '</tr>' +
            '<span class="hide">' + i + '</span>';

        for (var key in response.data) {
            i = i + 1; 
            res += '' +
            '<tr>' +
                '<td class="name">' + checkVariable(response.data[key].Name) +
                '</td>' +
                '<td class="' + statusTextColor(response.data[key].Status) + '">' + response.data[key].Status + '</td>' +
                '<td>' + getAUC(response.data[key].PerformanceMetrics.Properties.BinaryAUC) + '</td>' +
                '<td>' + timeConverter(response.data[key].LastUpdatedAt) + '</td>' +
                '<td>' +
                    '<a class="btn btn-info btn-sm btn-list datasource-info" href="#modal"' +
                        'data-toggle="modal" id="info_' + i + '" data-source-id="' + response.data[key].EvaluationId + '">' +
                        '<span class="glyphicon glyphicon-info-sign"></span>' +
                    '</a>&nbsp;' +
                    '<a class="btn btn-danger btn-sm btn-list delete" href="#" data-delete-id="' + response.data[key].EvaluationId +'">' +
                        '<span class="glyphicon glyphicon-trash"></span>' +
                    '</a>' +
                '</td>' +
            '</tr>' +
            '<span class="hide">' + i + '</span>';
        };

        res += '</table>';

        $('.container-describeEvaluations').html(res);
      
        $('.container-describeEvaluations').addClass('loaded');
    });
};