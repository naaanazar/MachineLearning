$(document).ready(function () {

    if (window.location.hash == '#describeDataSources') {
        listDataSource();
    }

    if (window.location.hash == '#describeDataSources') {
        listDataSource();
    }

    listDataSource();

    $('.create-datasource-form').submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: '/ml/create-datasource',
            data: $('.create-datasource-form').serialize(),
            success: function (data) {
                $(".create-datasource-form").toggle();
                $(".container-describeDataSources").toggle();
                listDataSource();
                console.log(data);
            },
            error: function () {
            },
        });
    });

    $(document).on("click", ".btn-create-datasource", function () {
        $(".create-datasource-form").toggle();
        $(".container-describeDataSources").toggle();


        $(document).on('blur', '.form-control', function (e) {
            $(e.target).blur(function () {
                var id = e.target.id;
                var val = e.target.value;
                $(this).closest('div').find('span').addClass('hide');

                switch (id) {
                    case 'DataSourceName':
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
                    case 'DataRearrangementBegin':
                        var rv_name = /^[1-9][0-9]?$|^100$/;

                        if (val.length > 0 && val != '' && rv_name.test(val)) {
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
                    case 'DataRearrangementEnd':
                        var rv_name = /^[1-9][0-9]?$|^100$/;

                        if (val.length > 0 && val != '' && rv_name.test(val)) {
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

            });
        });

        $.get("/ml/select-S3objects", function (response) {
            var result;
            for (var key in response.data) {
                result += '<option value="' + response.data[key].Key + '">' + response.data[key].Key + '</option>';
            }
            $('#SelectDataLocationS3').html(result);
        });
    });

    $(document).on("click", '#describeDataSourcesContent', function () {
        var button = '<button class="btn btn-primary btn-create-datasource pull-right">Create Datasource</button>'
        $('#ml-button-create').html(button);
        if (!$('.container-describeDataSources').hasClass('loaded')) {
            listDataSource();
        }
    });

    //    //loading data
    //    $('#describeDataSourcesContent').on('click', function() {
    //        $('.container-describeDataSources').html('<br><div class="row" id="modal_row"><div align="center" class="loader col-md-2 col-md-offset-5" id="loader"></div></div>');
    //    });

    function listDataSource() {

        $('.container-describeDataSources').html('<br><div class="" id="modal_row"><div align="center" class="loader col-md-2 col-md-offset-5" id="loader"></div></div>');
//        var button = '<button class="btn btn-primary btn-create-datasource pull-right">Create Datasource</button>'
//        $('#ml-button-create').html(button);

        $.get("/ml/describe-data-sources", function (response) {

            var i = 1;
            var res = '' +
                '<table class="table table-bordered table-font text-center">' +
                '<tr class="active">' +
                '<td>Name</td>' +
                '<td>Status</td>' +
                '<td>DataLocationS3</td>' +
                '<td>Last Updated</td>' +
                '<td>&nbsp;</td>' +
                '</tr>' +
                '<span class="hide">' + i + '</span>';
            for (var key in response.data) {
                i = i + 1;
                date = response.data[key].LastUpdatedAt.replace('T', '  ');
                date = date.substring(0, date.indexOf('+'));
                res += '' +
                    '<tr>' +
                    '<td class="hide">' + response.data[key].DataSourceId + '</td>' +
                    '<td>';
                if (response.data[key].Name !== undefined) {
                    res += response.data[key].Name;
                }
                res += '' +
                    '</td>' +
                    '<td>' + response.data[key].Status + '</td>' +
                    '<td>' + response.data[key].DataLocationS3 + '</td>' +
                    '<td>' + date + '</td>' +
                    '<td>' +
                    '<a class="btn btn-info btn-sm btn-list datasource-info" href="#modal"' + 'data-toggle="modal" id="info_' + i + '" data-source-id="' + response.data[key].DataSourceId + '"><span ' +
                    'class="glyphicon glyphicon-info-sign"></span></a>&nbsp;' +
                    '<a class="btn btn-danger btn-sm btn-list delete" href="#" data-delete-id="' + response.data[key].DataSourceId + '"><span class="glyphicon glyphicon-trash"></span></a>' +
                    '</td>' +
                    '</tr>' +
                    '<span class="hide">' + i + '</span>';
            }
            res += '</table>';

            $('.container-describeDataSources').html(res);
            $('.container-describeDataSources').addClass('loaded');
        });
    };
});