$(document).ready(function() {
    $(document).on("click", '.datasource-info', function(event) {
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
            case 'Models':
                url = '/ml/getmlmodel/';
                break;
            case 'Evaluations':
                url = '/ml/getevaluation/';
                break;
            case 'Batch Predictions':
                url = '/ml/getbatchprediction/';
                break;
        }

        $.get(url + datasourceId, function(response) {
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
                case 'Models':
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
                            '<td>' + parseName(key) + '</td>' +
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

        function parseName(str){
            var name = '';
            var posFirst = 0;
            for (var i=0; i<str.length; i++) {
                if (str.charCodeAt(i) > 65 && str.charCodeAt(i) <90) {
                    name += str.substring(posFirst,i) + ' ';
                    posFirst = i;
                }
            }
        return name = name + ' ' + str.substring(posFirst,str.length);
        }
        event.preventDefault();
    });

    // Delete Ajax
    $(document).on('click', '.delete', function(event) {
        var target = $(event.target).closest('div.container').find('div.row').find('div.tabs').find('div.ML-tabs').find('ul.nav-tabs').find('li.active').find('a').text();

        $(event.target).closest('tr').fadeOut();


        function deleteObject(dataSourceIdVar, url) {
            var datasourceId = $(event.target).closest('a').data('delete-id');
            var name = $(event.target).closest('tr').find('.name').text();

            if (target == dataSourceIdVar) {
                $.get(url + datasourceId, function(response) {
                    if (response.deleted !== 'Ok') {
                        $.jGrowl('An error occurred during delete process', {
                            theme: 'jgrowl-danger'
                        });
                    } else {

                        $.jGrowl('Successfully removed: ' + name, {
                            theme: 'jgrowl-success'
                        });

                    }
                });
            }
        }

        switch (target) {
            case 'Data Source':
                deleteObject('Data Source', '/ml/delete-datasource/');
                break;
            case 'Models':
                deleteObject('Models', '/ml/delete-ml-model/');
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
    $('.modal-1').on('hidden.bs.modal', function() {
        $('.modal-body-1').html('<div class="row" id="modal_row"><div align="center" class="loader col-md-2 col-md-offset-5" id="loader"></div></div>');
    });
});

function statusTextColor(str)
{
    if (str === 'COMPLETED') {
        classText = 'text-success';
    } else if (str === 'PENDING' || str === 'INPROGRESS') {
        classText = 'text-warning';
    } else if (str === 'FAILED') {
         classText = 'text-danger';
    }

    return classText;
};

function parseDate(str)
{
    var date = str.replace('T', '  ');
    date = date.substring(0, date.indexOf('+'));

    return date;
};

function selectName(uri, elementId, formClass)
{
    addSelectLoader(elementId, formClass);

    $.get(uri, function (response) {
        var result;
        var id;       

        for (var key in response.data) {
            if (response.data[key].hasOwnProperty('MLModelId')) {
                id = response.data[key].MLModelId;
            } else if (response.data[key].hasOwnProperty('DataSourceId')) {
                id = response.data[key].DataSourceId;
            };
            result += '<option value="' + id + '">' + response.data[key].Name + '</option>';
        };

        $(elementId).html(result);
        removeSelectLoader(elementId);
    });
};

function selectDataFromS3(uri, elementId, formClass)
{
    addSelectLoader(elementId, formClass);

    $.get(uri, function (response) {
        var result;

        for (var key in response.data) {
            var extension = response.data[key].Key.substr(-3);

            if ( extension == 'csv') {
                result += '<option value="' + response.data[key].Key + '">' + response.data[key].Key + '</option>';
            };
        };

        $(elementId).html(result);
        removeSelectLoader(elementId);


    });
};

function addSelectLoader(elementId, formClass)
{
    $(elementId).addClass('remove-arrow');
    var load = '<div class="loader-im" style="width: 28px; height: 28px; float: left;right: 4px;top: 30px;position: absolute;">' +
        '<div align="center" class="loader-select" id="loader"></div></div>';

    $(formClass).find(elementId).parents('.select-load').append(load);
};

function removeSelectLoader(elementId)
{
    $(elementId + ' + .loader-im').remove();
    $(elementId).removeClass('remove-arrow');
};

function addLoader(destinationClass) {
        $(destinationClass).html('<br><div id="modal_row"><div align="center" class="loader col-md-2 col-md-offset-5" id="loader"></div></div>');
};

function buttonCreate(elementClass, destinationId, name, dataTarget)
{
    var button = '<button class="btn btn-primary ' + elementClass + ' pull-right" data-toggle="modal" ' +
        'data-target="' + dataTarget + '">' + name + '</button>';

    $(destinationId).html(button);
}

function showLoader(destinationClass)
{
    $(destinationClass).html('<br><div id="modal_row"><div align="center" class="loader col-md-2 col-md-offset-5" id="loader"></div></div>');
}