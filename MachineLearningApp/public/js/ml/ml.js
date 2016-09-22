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

function selectDatasourceName(uri, elementId)
{
    $.get(uri, function (response) {
        var result;

        for (var key in response.data) {
            result += '<option value="' + response.data[key].DataSourceId + '">' + response.data[key].Name + '</option>';
        };

        $(elementId).html(result);
        removeSelectLoader(elementId);
    });
};

function selectModelName(uri, elementId)
{
    $.get(uri, function (response) {
        var result;

        for (var key in response.data) {
            result += '<option value="' + response.data[key].MLModelId + '">' + response.data[key].Name + '</option>';
        };

        $(elementId).html(result);
        removeSelectLoader(elementId);
    });
};

function selectDataFromS3(uri, elementId)
{
    $.get(uri, function (response) {
        var result;

        for (var key in response.data) {
            var ext = response.data[key].Key.substr(-3);

            if ( ext == 'csv') {
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
    $(formClass).find('.select-load').append(load);
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

function addLoader(destinationClass)
{
    $(destinationClass).html('<br><div id="modal_row"><div align="center" class="loader col-md-2 col-md-offset-5" id="loader"></div></div>');
}