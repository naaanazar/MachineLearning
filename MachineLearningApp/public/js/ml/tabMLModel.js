$(document).ready(function() {

    $(document).on("click", ".btn-create-mlmodel", function () {
        $('.create-mlmodel').toggle();
        $(".container-describeMLModels").toggle();

        $.get("/ml/select-data-source", function(response){
            var  result;

            for (var key in response.data) {

                result += '<option value="' + response.data[key].DataSourceId + '">' + response.data[key].Name + '</option>';
            }
            $('#SelectDataSource').html(result);
        });
    });

    $(document).on("click", '#describeMLModelsContent', function () {
        var button = '<button class="btn btn-primary btn-create-mlmodel pull-right">Create ML Mode</button>'
        $('#ml-button-create').html(button);

        $.get("/ml/describe-ml-model", function(response){
            var i=1;
            var res = '' +
                '<table class="table table-bordered table-font text-center">' +
                    '<tr class="active">' +
                        '<td>MLModelId</td>' +
                        '<td>Name</td>' +
                        '<td>Status</td>' +
                        '<td>EndpointStatus</td>' +
                        '<td>TrainingDataSourceId</td>' +
                        '<td>MLModelType</td>' +
                        '<td>Last Updated</td>' +
                        '<td>&nbsp;</td>' +
                    '</tr>' +
                    '<span class="hide">' + i + '</span>';
                    for (var key in response.data) {
                    i = i+1;
                    date = response.data[key].LastUpdatedAt.replace('T', '  ');
                    date = date.substring(0, date.indexOf('+'));
                    res += '' +
                        '<tr>' +
                            '<td>' + response.data[key].MLModelId + '</td>' +
                            '<td>';
                                if (response.data[key].Name !== undefined) {
                                    res += response.data[key].Name;
                                }
                            res += '' +
                            '</td>' +
                            '<td>' + response.data[key].Status + '</td>' +
                            '<td>' + response.data[key].EndpointInfo.EndpointStatus + '</td>' +
                            '<td>' + response.data[key].TrainingDataSourceId + '</td>' +
                            '<td>' + response.data[key].MLModelType + '</td>' +
                            '<td>' + date + '</td>' +
                            '<td>' +
                                '<a class="btn btn-info btn-sm btn-list datasource-info" href="#modal"' +
                                   'data-toggle="modal" id="info_' + i + '">' +
                                    '<span class="glyphicon glyphicon-info-sign"></span></a>&nbsp;' +
                                '<a class="btn btn-danger btn-sm btn-list delete" href="#"><span class="glyphicon glyphicon-trash"></span></a>' +
                            '</td>' +
                        '</tr>' +
                        '<span class="hide">' + i + '</span>';
                    }
                res += '</table>';

            $('.container-describeMLModels').html(res);
        });
     });
});