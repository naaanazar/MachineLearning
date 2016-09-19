$(document).ready(function() {

    if (window.location.hash == '#describeEvaluations') {
        buttonCreateEvaluation();
        listEvaluations();
    }

    $('.create-evaluations-form').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: 'ml/create-evaluation',
            data: $('.create-evaluations-form').serialize(),
            success: function(data) {
                $(".create-evaluations-form").toggle();
                $(".container-describeEvaluations").toggle();
                listEvaluations();
                console.log(data);
            },
            error: function() {},
        });
    });

    $(document).on('blur', '.form-control', function (e) {
        var id = e.target.id;
        var val = e.target.value;
        $(this).closest('div').find('span').addClass('hide');

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
            $(this).closest('form').find('button').addClass('disabled');
        } else {
            $(this).closest('form').find('button').removeClass('disabled');
        }

    });

    $(document).on("click", ".btn-create-evaluations", function() {
        $(".create-evaluations-form").toggle();
        $(".container-describeEvaluations").toggle();

        $.get("/ml/select-ml-model", function(response) {
            var result;

            for (var key in response.data) {

                result += '<option value="' + response.data[key].MLModelId + '">' + response.data[key].Name + '</option>';
            }
            $('#SelectMLModelId').html(result);
        });

        $.get("/ml/select-data-source", function(response) {
            var result;

            for (var key in response.data) {

                result += '<option value="' + response.data[key].DataSourceId + '">' + response.data[key].Name + '</option>';
            }
            $('#SelectEvDataSource').html(result);
        });
    });

    $(document).on("click", '#describeEvaluationsContent', function () {
        var button = '<button class="btn btn-primary btn-create-evaluations pull-right">Create Evaluations</button>'
        $('#ml-button-create').html(button);
        if(!$('.container-describeEvaluations').hasClass('loaded')) {
            listEvaluations();
        }
    });

    function buttonCreateEvaluation() {
       var button = '<button class="btn btn-primary btn-create-evaluations pull-right">Create Evaluations</button>'
        $('#ml-button-create').html(button);
    };

    function listEvaluations() {
        $('.container-describeEvaluations').html('<br><div class="" id="modal_row"><div align="center" class="loader col-md-2 col-md-offset-5" id="loader"></div></div>');
        $.get("/ml/describe-evaluations", function(response) {
            var i = 1;
            var res = '' +
                '<table class="table table-bordered table-font text-center">' +
                '<tr class="active">' +
                //'<td>Evaluation ID</td>' +
                '<td>Name</td>' +
                '<td>Status</td>' +
                '<td class="red-tooltip" >Binary AUC</td>' +
                //'<td>ML Model Id</td>' +
                //'<td>Evaluation Data Source Id</td>' +
                '<td>Last Updated</td>' +
                '<td>&nbsp;</td>' +
                '</tr>' +
                '<span class="hide">' + i + '</span>';
            for (var key in response.data) {
                var i = i + 1;
                var date = response.data[key].LastUpdatedAt.replace('T', '  ');
                date = date.substring(0, date.indexOf('+'));
                var auc = '';
                if (response.data[key].PerformanceMetrics.Properties.BinaryAUC !== undefined) {
                    auc = +Math.round(response.data[key].PerformanceMetrics.Properties.BinaryAUC * 1000) / 1000;
                }
                res += '' +
                    '<tr>' +
                    //'<td>' + response.data[key].EvaluationId + '</td>' +
                    '<td>';
                if (response.data[key].Name !== undefined) {
                    res += response.data[key].Name;
                }
                res += '' +
                    '</td>' +
                    '<td>' + response.data[key].Status + '</td>' +
                    '<td>' +
                    auc +
                    '</td>' +
                   //'<td>' + response.data[key].MLModelId + '</td>' +
                    //'<td>' + response.data[key].EvaluationDataSourceId + '</td>' +
                    '<td>' + date + '</td>' +
                    '<td>' +
                    '<a class="btn btn-info btn-sm btn-list datasource-info" href="#modal"' +
                    'data-toggle="modal" id="info_' + i + '" data-source-id="' + response.data[key].EvaluationId + '">' +
                    '<span class="glyphicon glyphicon-info-sign"></span></a>&nbsp;' +
                    '<a class="btn btn-danger btn-sm btn-list delete" href="#" data-delete-id="' + response.data[key].EvaluationId + '"><span class="glyphicon glyphicon-trash"></span></a>' +
                    '</td>' +
                    '</tr>' +
                    '<span class="hide">' + i + '</span>';
            }
            res += '</table>';

            $('.container-describeEvaluations').html(res);
            $('.container-describeEvaluations').addClass('loaded');
        });
    }
});