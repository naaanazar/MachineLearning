$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function showLoader() {
    $('i.fa-spinner').css('display', 'inline-block');
}

function hideLoader() {
    $('i.fa-spinner').hide();
}

function enableGenerateProcess(withInput) {
    $('#generate-btn').removeClass('disabled');
    $('#generate-btn').prop('disabled', false);

    if (withInput) {
        $('#rows-number').prop('disabled', false);
    }
}

function disableGenerateProcess(withInput) {
    $('#generate-btn').addClass('disabled');
    $('#generate-btn').prop('disabled', true);

    if (withInput) {
        $('#rows-number').prop('disabled', true);
    }
}

function showMessage(message, error) {
    var $input = $('#rows-number');
    var $message = $('.empty-msg');

    $message.html(message);

    if (error) {
        $input.addClass('warning');
        $message.addClass('error');
    } else {
        $input.removeClass('warning');
        $message.removeClass('error');
    }
}

function hideMessage() {
    $('.empty-msg').empty();

    if ($('#rows-number').hasClass('warning')) {
        $('#rows-number').removeClass('warning');
    }

    if (!$('.empty-msg').hasClass('error')) {
        $('.empty-msg').addClass('error');
    }
}

function bindEvents() {
    $(document).on('input', '#rows-number', function (e) {
        var value = $(e.target).val();
        var newValue = value.replace(/^0|\D+/g, '');
        var maxLength = 6;

        if (newValue.length > maxLength) {
            newValue = parseInt(newValue.toString().substr(0, maxLength));
        }

        $("#rows-number").val(newValue);

        if ($("#rows-number").val() !== "") {
            enableGenerateProcess();
        } else {
            disableGenerateProcess();
        }
    });

    $('#generate-btn').click(function () {
        var rowsNumber = $('#rows-number').val();
        if (rowsNumber === '') {
            showMessage('This field is required!', true);
            return;
        }

        hideMessage();
        disableGenerateProcess(true);
        showLoader();

        $.ajax({
            method: 'POST',
            url: 'generate',
            dataType: 'JSON',
            data: {
                rows: rowsNumber,
                "_token": $('meta[name=csrf-token]').attr('content')
            },
            success: function (data) {
                enableGenerateProcess(true);
                hideLoader();

                $("#rows-number").val("");

                if (!$.isEmptyObject(data)) {
                    var stats = data.stats;
                    var link = "<a href='datasets/" + stats.path + "'>dataset</a>";

                    var content = '<ul>';
                    content += '<li>Records number: ' + stats.recordsNumber + '</li>';
                    content += '<li>Purchase number: ' + stats.purchaseNumber + '</li>';
                    content += '<li>Purchase percentage: ' + stats.purchasePercentage + '</li>';
                    content += '<li>Link to dataset: ' + link + '</li>';
                    content += '</ul>';

                    showMessage(content, false);
                }
            },
            error: function (response) {
                enableGenerateProcess(true);
                hideLoader();

                if (response.responseJSON) {
                    showMessage(response.responseJSON.rows.join('<br>'), true);
                } else {
                    $.jGrowl(
                        "Internal error! Server responded with: " + 
                        "Code " + response.status + " " + response.statusText, {
                        theme: 'jgrowl-danger',
                        sticky: true
                    });
                }
            }
        });
    });
}

$(document).ready(function () {
    bindEvents();
});