$(document).ready(function() {

    $(document).on("click", ".btn-create-bath-description", function () {
        $(".create-bath-descriptions").toggle();
        $(".container-describeBatchPredictions").toggle();

        $.get("/ml/select-ml-model", function(response){
            var  result;

            for (var key in response.data) {

                result += '<option value="' + response.data[key].MLModelId + '">' + response.data[key].Name + '</option>';
            }
            $('#SelectBathMLModel').html(result);
        });

        $.get("/ml/select-data-source", function(response){
            var  result;

            for (var key in response.data) {

                result += '<option value="' + response.data[key].DataSourceId + '">' + response.data[key].Name + '</option>';
            }
            $('#SelectBathDataSource').html(result);
        });
    });

    $(document).on("click", '#describeBatchPredictionsContent', function () {
        var button = '<button class="btn btn-primary btn-create-bath-description pull-right">Create bath prediction</button>'
        $('#ml-button-create').html(button);

        $.get("/ml/describe-batch-prediction", function(response){
            var i=1;
            var res = '' +
                '<table class="table table-bordered table-font text-center">' +
                '<tr class="active">' +
                    '<td>BatchPredictionId</td>' +
                    '<td>Name</td>' +
                    '<td>Status</td>' +
                    '<td>MLModelId</td>' +
                    '<td>BatchPredictionDataSourceId</td>' +
                    '<td>OutputUri</td>' +
                    '<td>Count</td>' +
                    '<td>Last Updated</td>' +
                    '<td>&nbsp;</td>' +
                '</tr>' +
                '<span class="hide">'+ i +'</span>';
                for (var key in response.data) {
                    i = i+1;
                    var date = response.data[key].LastUpdatedAt.replace('T', '  ');
                    date = date.substring(0, date.indexOf('+'));
                    res +=
                        '<tr>' +
                            '<td>' + response.data[key].BatchPredictionId + '</td>' +
                            '<td>' + response.data[key].Name + '</td>' +
                            '<td>' + response.data[key].Status + '</td>' +
                            '<td>' + response.data[key].MLModelId + '</td>' +
                            '<td>' + response.data[key].BatchPredictionDataSourceId + '</td>' +
                            '<td>' + response.data[key].OutputUri + '</td>' +
                            '<td>';
                                if (response.data[key].TotalRecordCount !== undefined) {
                                    res += response.data[key].TotalRecordCount;
                                };
                    res +=  '</td>' +
                            '<td>' + date + '</td>' +
                            '<td>' +
                                '<a class="btn btn-info btn-sm btn-list datasource-info" href="#modal"' +
                                   'data-toggle="modal" id="info_' + i +'">' +
                                    '<span class="glyphicon glyphicon-info-sign"></span></a>&nbsp;' +
                                '<a class="btn btn-danger btn-sm btn-list delete" href="#"><span class="glyphicon glyphicon-trash"></span></a>' +
                            '</td>' +
                        '</tr>' +
                    '<span class="hide">' + i + '</span>';
                }
            res += '</table>';

            $('.container-describeBatchPredictions').html(res);
        });
     });
});
