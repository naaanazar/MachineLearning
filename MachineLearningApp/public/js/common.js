$(document).ready(function () {
    // tooltip from upload button
    $("[data-toggle='tooltip']").tooltip();

    // upload button without submit
    $('#input-file').change(function () {
        $('.form-upload').submit();
    });

    // upload show/hide message
    $(".upload-message").show().delay(1500).fadeOut(1000);

    // delete row from s3 table using ajax
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function success(selector, str) {
        $(selector).append('<div class="alert alert-success upload-message-s3">'
            + '<ul><li><strong>Success! </strong>'
            + str + '</li></ul></div>').show('slow').hide(4000);
    }

    function errorS3(selector) {
        $(selector).append('<div class="alert alert-danger upload-message-s3">'
            + '<ul><li><strong>Error! File is not loaded to S3!</strong>'
            + '</li></ul></div>').show('slow').hide(4000);

    }

    $(document).on('click', '.btn-delete', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        $.ajax({
            url: '/s3/delete',
            method: 'post',
            data: {name: $(this).attr('id')},
            success: function (data) {
                console.log(data);
                if (data.success) {

                    $(e.target).closest('tr').hide("fast");
                }
                success('.notification-s3', 'File delete!');
            }
        });
    });

    //upload file to s3 bucket using ajax
    $('.form-upload').on("submit", function (e) {
        console.log($(".form-upload"));
        e.preventDefault();
        $('.preload-s3').show('fast').delay(4000).fadeOut(400);
        $.ajax({
            url: '/s3/upload',
            method: 'POST',
            data: new FormData($(".form-upload")[0]),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                getListS3();
                success('.notification-s3', 'File uploaded to S3!');
            },
            error: function () {
                errorS3('.notification-s3');
            },
        });
    });

    // update list s3
    function getListS3() {
        $.ajax({
            url: '/s3/list',
            method: 'GET',
            success: function (data) {
                $('.s3-pagination').html($(data).find('div.pagination-list'));
                $('.s3-table').html($(data).find('table'));
            }
        });
    }

    // prediction: get id model
    $.get("/ml/select-ml-model", function (response) {
        var result;

        for (var key in response.data) {

            result += '<option value="' + response.data[key].MLModelId + '">' + response.data[key].Name + '</option>';
        }
        $('#ml_model_id').html(result);
    });

    // prediction: send form
    $('.form-prediction').on('submit', function (e) {
        e.preventDefault();

        addPredictionProgress();

        $.ajaxSetup({
            headers: {'X-XSRF-Token': $('meta[name="_token"]').attr('content')}
        });

        var formData = $(this).serialize();
        var formAction = $(this).attr('action');
        var formMethod = $(this).attr('method');

        function formPredict() {
            $.ajax({
                type: formMethod,
                url: formAction,
                data: formData,
                cache: false,
                success: function (data) {
                    if (data == 'Updating') {
                        setTimeout(formPredict(), 3000);
                    }
                    else {
                        removePredictionProgress()
                        $('.prediction-data').append('<h1 class="text-center">Result</h1> ' + data);
                    }
                },
                error: function () {
                    setTimeout(formPredict(), 3000);
                }
            });
        }

        formPredict();
    });

    // prediction: form processing style
    function addPredictionProgress() {
        $('.spinner-prediction').fadeIn('slow');
        $('.prediction-data').empty();
    }

    function removePredictionProgress() {
        $('.spinner-prediction').fadeOut('slow');
    }


    // prediction: send form
    $('.form-prediction').on('submit', function(e) {
        e.preventDefault();

        addPredictionProgress();

        $.ajaxSetup({
            headers: { 'X-XSRF-Token': $('meta[name="_token"]').attr('content') }
        });

        var formData   = $(this).serialize();
        var formAction = $(this).attr('action');
        var formMethod = $(this).attr('method');

        function formPredict() {
            $.ajax({
                type    : formMethod,
                url     : formAction,
                data    : formData,
                cache   : false,
                success : function(data) {
                              if (data == 'Updating') {
                                  setTimeout(formPredict(), 3000);
                              }
                              else {
                                removePredictionProgress();
                                $('.prediction-data').append("<section class='pred-data'>"
                                    + "<h1 class='text-center'>Result</h1>"
                                    + data + "</section>");
                              }
                          },
                error   : function() {
                              setTimeout(formPredict(), 3000);
                          }
            });
        }

        formPredict();
    });

    // prediction: form processing style
    function addPredictionProgress() {
        $('.spinner-prediction').fadeIn('slow');
        $('.prediction-data').empty();
    }

    function removePredictionProgress() {
        $('.spinner-prediction').hide('slow');
    }

    // prediction: validation form
    function predValOne(selector) {
        $('.form-prediction').on('input', selector, function(e){
            var value = $(e.target).val();
            var regExp = new RegExp("[^0-1]", "g");
            value = value.replace(regExp, "");
            $(selector).val(value.substr(0, 1));
        });
    }

    function predValTwo(selector, length) {
        $('.form-prediction').on('input', selector, function(e){
            var value = $(e.target).val();
            var regExp = new RegExp("[^0-9]", "g");
            var value = value.replace(regExp, "");
            $(selector).val(value.substr(0, length));
        });
    }

    function predValCountry(selector, length) {
        $('.form-prediction').on('input', selector, function(e){
            var value = $(e.target).val();
            var regExp = new RegExp("^ |[^a-zA-Z ]", "g");
            var value = value.replace(regExp, "");
            $(selector).val(value.substr(0, length));
        });
    }

    predValOne("#email");
    predValOne("#has-privat-project");
    predValOne("#same-log-project");
    predValTwo("#same-email", 10);
    predValTwo("#projects-count", 10);
    predValTwo("#string-count");
    predValTwo("#string-count", 10);
    predValTwo("#members-count", 10);
    predValTwo("#last-login", 10);
    predValCountry("#country", 60)

//modal window ML
    $(document).on("click", '.datasource-info', function (event) {
        var datasourceId = $(event.target).closest('a').data('source-id');
        var tab = $(event.target).closest('div.container').find('div.row').find('div.tabs').find('div.ML-tabs').find('ul.nav-tabs').find('li.active').find('a').text();

        var temp = $(event.target).closest('a').attr('href');

        var data = {
            Name: "",
            Message: ""
        };

        var url;

        switch (tab) {
            case 'Data Source':
                url = '/ml/getdatasource/';
                break;
            case 'ML Models':
                url = '/ml/getmlmodel/';
                break;
            case 'Evaluations':
                url = '/ml/getevaluation/';
                break;
            case 'Batch Predictions':
                url = '/ml/getbatchprediction/';
                break;

        }

        $.get(url + datasourceId, function (response) {
            switch (tab) {
                case 'Data Source':
                    data.Name = response.data[0];
                    data.Message = response.data[3];
                    data.Size = response.data[1] + ' Bytes';
                    data.NumberOfFiles = response.data[2] + ' Files';
                    data.Location = response.data[4];
                    data.DataSourceId = response.data[5];
                    data.DatasetId = response.data[6];
                    break;
                case 'ML Models':
                    data.Name = response.data[0];
                    data.Message = response.data[3];
                    data.Size = response.data[1] + ' Bytes';
                    data.DataLocation = response.data[2];
                    data.ModelId = response.data[4];
                    data.TrainingData = response.data[5];
                    break;
                case 'Evaluations':
                    data.Name = response.data[0];
                    data.Message = response.data[3];
                    data.ComputeTime = response.data[1];
                    data.DataLocation = response.data[2];
                    data.EvaluationId = response.data[4];
                    data.ModelId = response.data[5];
                    data.EvaluationData = response.data[6];
                    break;
                case 'Batch Predictions':
                    data.Name = response.data[0];
                    data.Message = response.data[3];
                    data.ComputeTime = response.data[1];
                    data.DataLocation = response.data[2];
                    data.BatchPredictionId = response.data[4];
                    data.BatchPredictionDataSourceId = response.data[5];
                    data.ModelId = response.data[6];
                    break;
            }

            display(data);
        });

        function display(data) {
            var thead = '<thead>';
            var tbody = '<tbody>';

            for (var key in data) {
                if (key === 'Name') {
                    thead += '' +
                        '<tr>' +
                        '<th>Name</th>' +
                        '<th>' + data.Name + '</th>' +
                        '</tr>';
                } else {
                    if (typeof data[key] !== 'undefined') {
                        tbody += '' +
                            '<tr>' +
                            '<td>' + key + '</td>' +
                            '<td>' + data[key] + '</td>' +
                            '</tr>';
                    }
                }
            }

            thead += '</thead>';
            tbody += '</tbody';

            var result = '<table class="table table-condensed">' + thead + tbody + '</table>';

            $('#result_info').html(result);
        }

        event.preventDefault();
    });

    // Delete Ajax
    $(document).on('click', '.delete', function (event) {
        var target = $(event.target).closest('div.container').find('div.row').find('div.tabs').find('div.ML-tabs').find('ul.nav-tabs').find('li.active').find('a').text();

        $(event.target).closest('tr').fadeOut();

        function deleteObject(dataSourceIdVar, url) {
            var datasourceId = $(event.target).closest('a').data('delete-id');

            if (target == dataSourceIdVar) {
                $.get(url + datasourceId, function (response) {
                    if (response.deleted !== 'Ok') {
                        $.jGrowl('An error occurred during delete process', {theme: 'jgrowl-danger'});
                    }else {
                        $.jGrowl('Success', {theme: 'jgrowl-success'});

                    }
                });
            }
        }

        switch (target) {
            case 'Data Source':
                deleteObject('Data Source', '/ml/delete-datasource/');
                break;
            case 'ML Models':
                deleteObject('ML Models', '/ml/delete-ml-model/');
                break;
            case 'Evaluations':
                deleteObject('Evaluations', '/ml/delete-evaluation/');
                break;
            case 'Batch Predictions':
                deleteObject('Batch Predictions', '/ml/delete-batch-prediction/');
                break;
        }

        event.preventDefault();
    });

        //loading data
        $('.modal').on('hidden.bs.modal', function() {
            $('.modal-body').html('<div class="row" id="modal_row"><div align="center" class="loader col-md-2 col-md-offset-5" id="loader"></div></div>');
        });

});
