$(document).ready(function () {

    if (window.location.hash == '#describeDataSources' || window.location.hash === '') {
        buttonCreateDataSource();
        listDataSource();
    }

//    listDataSource();

    $('.create-datasource-form').submit(function (e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: '/ml/create-datasource',
            data: $('.create-datasource-form').serialize(),
            success: function (data) {
                $(".modalCreateDataSource").modal('toggle');
                //$(".create-datasource-form").toggle();
                //$(".container-describeDataSources").toggle();
                listDataSource();
                console.log(data);
            },
            error: function () {
            },
        });
    });

    $(document).on('blur', '.form-control', function (e) {

        var id = e.target.id;
        var val = e.target.value;

        switch (id) {
            case 'DataSourceName':
                var rv_name = /^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$/;

                if (val.length > 2 && val != '' && rv_name.test(val)) {
                    $(this).removeClass('error').addClass('not_error');
                    $(this).closest('div').removeClass('has-error');
                    $(this).closest('div').addClass('has-success has-feedback');
                    $(this).closest('div').find('span').removeClass('hide');
                    console.log('Hello');

                }
                else {
                    $(this).removeClass('not_error').addClass('error');
                    $(this).closest('div').addClass('has-error has-feedback');
                    $(this).closest('div').find('span').addClass('hide');
                }
                break;
            case 'DataRearrangementBegin':
                var rv_name = /^[0-9][0-9]?$|^100$/;

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

        if ($(this).closest('form.create-datasource-form').find('div.has-error').hasClass('has-error') == true) {
            $(this).closest('form').find('input#success-button-modal-ds').attr('disabled', 'disabled');
        } else {
            $(this).closest('form').find('input#success-button-modal-ds').removeAttr('disabled');
        }
    });

    $(document).on("click", ".btn-create-datasource", function () {
        //   $(".create-datasource-form").toggle();
        //  $(".container-describeDataSources").toggle();

        $('#SelectDataLocationS3').addClass('remove-arrow');
        var load = '<div class="loader-im" style="width: 28px; height: 28px; float: left;right: 4px;top: 30px;position: absolute;">' +
            '<div align="center" class="loader-select" id="loader"></div></div>';
        $('.create-datasource-form').find('.select-load').append(load);
        $.get("/ml/select-S3objects", function (response) {
            var result;
            for (var key in response.data) {
                ext = response.data[key].Key.substr(-3);

                if ( ext == 'csv') {
                    result += '<option value="' + response.data[key].Key + '">' + response.data[key].Key + '</option>';
                }
            }
            $('#SelectDataLocationS3').html(result);
            $('#SelectDataLocationS3 + .loader-im').remove();
            $('#SelectDataLocationS3').removeClass('remove-arrow');
        });
    });

    $(document).on("click", '#describeDataSourcesContent', function () {
        buttonCreateDataSource();

        if (!$('.container-describeDataSources').hasClass('loaded')) {
            listDataSource();
        }
    });

    $(document).on('click', '.datasource-update', function (e) {
        e.preventDefault();
        console.log($(this).data('model-id'));

        $.post('/ml/datasource-update', {
            id: $(this).data('source-id'),
            name:$(this).data('source-name')}, function (data) {
            console.log(data);

        });
    });


    function buttonCreateDataSource() {
        var button = '<button class="btn btn-primary btn-create-datasource pull-right" data-toggle="modal" ' +
            'data-target="#modalCreateDataSource">Create Datasource</button>';
        $('#ml-button-create').html(button);
    }

    function listDataSource() {
        buttonCreateDataSource();
        $('.container-describeDataSources').html('<br><div class="" id="modal_row"><div align="center" class="loader col-md-2 col-md-offset-5" id="loader"></div></div>');

        $.get("/ml/describe-data-sources", function (response) {

            var i = 1;
            var res = '' +
                '<table class="table table-bordered table-font text-center">';
//                '<thead>' +
//                '<tr class="active">' +
//                '<th>Name</th>' +
//                '<th>Status</th>' +
//                '<th>Data Location S3</th>' +
//                '<th>Last Updated</th>' +
//                '<th>&nbsp;</th>' +
//                '</tr>' +
//                '</thead>' +
//                '<span class="hide">' + i + '</span>';

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

            var headers = ''+
                '<div class="table-headers">' +
                '<span>Name</span>' +
                '<span>Status</span>' +
                '<span>Data Location S3</span>' +
                '<span>Last Updated</span>' +
                '<span>&nbsp;</span>' +
                '</div>';

            $('.container-describeDataSources').html(res);
            $('.container-describeDataSources').before(headers);
            setTableHeadersWidth();
            $('.container-describeDataSources').addClass('loaded');
        });
    };
});



function setTableHeadersWidth()
{
    var headerCols = $('.table-headers > span');
    var cols = $('#describeDataSources table tbody tr:first-child td');

    for(var i = 1; i < cols.length; i++ ) {
        var colWidth = $(cols[i]).outerWidth();
        console.log(colWidth);
        $(headerCols[i-1]).outerWidth(colWidth);
    }
}