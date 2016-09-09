$(document).ready(function() {

    listDataSource();

    $(document).on("click", ".btn-create-datasource", function () {
        $(".create-datasource").toggle();
        $(".container-describeDataSources").toggle();

        $.get("/ml/select-S3objects", function(response){
            var  result;
            for (var key in response.data) {
                result += '<option value="' + response.data[key].Key + '">' + response.data[key].Key + '</option>';
            }
            $('#SelectDataLocationS3').html(result);
        });
    });

    $(document).on("click", '#describeDataSourcesContent', function () {
        listDataSource();
     });

    function listDataSource() {

        var button = '<button class="btn btn-primary btn-create-datasource pull-right">Create Datasource</button>'
        $('#ml-button-create').html(button);

        $.get("/ml/describe-data-sources", function(response){
            var i=1;
            var res = '' +
                '<table class="table table-bordered table-font text-center">' +
                                '<tr class="active">' +
                                    '<td>DataSourceId</td>' +
                                    '<td>Name</td>' +
                                    '<td>Status</td>' +
                                    '<td>DataLocationS3</td>' +
                                    '<td>Last Updated</td>' +
                                    '<td>&nbsp;</td>' +
                                '</tr>' +
                                '<span class="hide">' + i + '</span>';
                                for (var key in response.data) {
                                    i = i+1;
                                    res += '' +
                                    '<tr>' +
                                        '<td>' + response.data[key].DataSourceId + '</td>' +
                                        '<td>';
                                            if (response.data[key].Name !== undefined) {
                                                res += response.data[key].Name;
                                            }
                                        res += '' +
                                        '</td>' +
                                        '<td>' + response.data[key].Status + '</td>' +
                                        '<td>' + response.data[key].DataLocationS3 + '</td>' +
                                        '<td>' + response.data[key].LastUpdatedAt + '</td>' +
                                        '<td>' +
                                            '<a class="btn btn-info btn-sm btn-list datasource-info" href="#modal"' +
                                               'data-toggle="modal" id="info_' + i + '"><span ' +
                                                        'class="glyphicon glyphicon-info-sign"></span></a>&nbsp;' +
                                            '<a class="btn btn-danger btn-sm btn-list delete" href="#"><span class="glyphicon glyphicon-trash"></span></a>' +
                                        '</td>' +
                                    '</tr>' +
                                    '<span class="hide">' + i + '</span>';
                                }
                            res += '</table>';

            $('.container-describeDataSources').html(res);
        });
    };
});