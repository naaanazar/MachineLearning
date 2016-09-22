$(document).ready(function() {

    if (window.location.hash == '#describeEvaluations') {
        buttonCreate(' btn-create-evaluations', '#ml-button-create', 'Create Evaluations', '#modalCreateEvaluation');
        listEvaluations();
    }

    $('.create-evaluations-form').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: 'ml/create-evaluation',
            data: $('.create-evaluations-form').serialize(),
            success: function(data) {                
                $(".modalCreateEvaluation").modal('toggle');
                listEvaluations();
                console.log(data);
            },
            error: function() {},
        });
    });

    $(document).on('blur', '.form-control', function (e) {
        var id = e.target.id;
        var val = e.target.value;

        switch (id) {
            case 'EvaluationName':
                var rv_name = /^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$/;

                if (val.length > 2 && val != '' && rv_name.test(val)) {
                    $(this).removeClass('error').addClass('not_error');
                    $(this).closest('div').removeClass('has-error');
                    $(this).closest('div').addClass('has-success has-feedback');
                    $(this).closest('div').find('span').removeClass('hide');

                }
                else {
                    $(this).removeClass('not_error').addClass('error');
                    $(this).closest('div').addClass('has-error has-feedback');
                    $(this).closest('div').find('span').addClass('hide');
                }
                break;
        }

        if ($(this).closest('form').find('div.has-error').hasClass('has-error') == true) {
            $(this).closest('form').find('input#success-button-modal-ev').attr('disabled', 'disabled');
        } else {
            $(this).closest('form').find('input#success-button-modal-ev').removeAttr('disabled');
        }

    });

    $(document).on("click", ".btn-create-evaluations", function() {
        addSelectLoader('#SelectMLModelId, #SelectEvDataSource', '.create-evaluations-form');
        selectModelName('/ml/select-ml-model', '#SelectMLModelId');
        selectDatasourceName('/ml/select-data-source', '#SelectEvDataSource');
    });

    $(document).on("click", '#describeEvaluationsContent', function () {
        buttonCreate('btn-create-evaluations', '#ml-button-create', 'Create Evaluations', '#modalCreateEvaluation');

        if(!$('.container-describeEvaluations').hasClass('loaded')) {
            listEvaluations();
        }
    });
    
});

function listEvaluations()
{
    addLoader('.container-describeEvaluations');
  
    $.get("/ml/describe-evaluations", function(response) {
        var i = 1;
        var auc;
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
            auc = '';
            var date = parseDate(response.data[key].LastUpdatedAt);
            var classText = statusTextColor(response.data[key].Status);            

            if (response.data[key].PerformanceMetrics.Properties.BinaryAUC !== undefined) {
                auc = +Math.round(response.data[key].PerformanceMetrics.Properties.BinaryAUC * 1000) / 1000;
            };
                
            res += '' +
                '<tr>' +
                    '<td class="name">';

            if (response.data[key].Name !== undefined) {
                res += response.data[key].Name;
            };

            res += '' +
                '</td>' +
                '<td class="' + classText + '">' + response.data[key].Status + '</td>' +
                '<td>' + auc +
                '</td>' +
                '<td>' + date + '</td>' +
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