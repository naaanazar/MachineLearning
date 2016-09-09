$(document).ready(function() {

    $(document).on("click", ".btn-create-evaluations", function () {
        $(".create-evaluations").toggle();
        $(".container-describeEvaluations").toggle();

        $.get("/ml/select-ml-model", function(response){
            var  result;

            for (var key in response.data) {

                result += '<option value="' + response.data[key].MLModelId + '">' + response.data[key].Name + '</option>';
            }
            $('#SelectMLModelId').html(result);
        });

        $.get("/ml/select-data-source", function(response){
            var  result;

            for (var key in response.data) {

                result += '<option value="' + response.data[key].DataSourceId + '">' + response.data[key].Name + '</option>';
            }
            $('#SelectEvDataSource').html(result);
        });
    });

    $(document).on("click", '#describeEvaluationsContent', function () {
        var button = '<button class="btn btn-primary btn-create-evaluations pull-right">Create Evaluations</button>'
        $('#ml-button-create').html(button);

        $.get("/ml/describe-evaluations", function(response){
            var i=1;
            var res = '' +
                '<table class="table table-bordered table-font text-center">' +
                    '<tr class="active">' +
                       '<td>EvaluationId</td>' +
                        '<td>Name</td>' +
                        '<td>Status</td>' +
                        '<td>BinaryAUC</td>' +
                        '<td>MLModelId</td>' +
                        '<td>EvaluationDataSourceId</td>' +
                        '<td>Last Updated</td>' +
                        '<td>&nbsp;</td>' +
                    '</tr>' +
                    '<span class="hide">' + i + '</span>';
                    for (var key in response.data) {
                    i = i+1;
                    res += '' +
                        '<tr>' +
                            '<td>' + response.data[key].EvaluationId + '</td>' +
                            '<td>';
                                if (response.data[key].Name !== undefined) {
                                    res += response.data[key].Name;
                                }
                            res += '' +
                            '</td>' +
                            '<td>' + response.data[key].Status + '</td>' +
                            '<td>';
                                if (response.data[key].PerformanceMetrics.Properties.BinaryAUC !== undefined) {
                                    res +=response.data[key].PerformanceMetrics.Properties.BinaryAUC;
                                }
                            res += '' +
                            '</td>' +
                            '<td>' + response.data[key].MLModelId + '</td>' +
                            '<td>' + response.data[key].EvaluationDataSourceId + '</td>' +
                            '<td>' + response.data[key].LastUpdatedAt + '</td>' +
                            '<td>' +
                                '<a class="btn btn-info btn-sm btn-list datasource-info" href="#modal"' +
                                   'data-toggle="modal" id="info_' + i + '">' +
                                    '<span class="glyphicon glyphicon-info-sign"></span></a>&nbsp;' +
                                '<a class="btn btn-danger btn-sm btn-list delete" href="#"><span class="glyphicon glyphicon-trash"></span></a>' +
                            '</td>' +
                        '</tr>' +
                        '<span class="hide">' + i +'</span>';
                    }
                res += '</table>';

            $('.container-describeEvaluations').html(res);
        });
     });
});