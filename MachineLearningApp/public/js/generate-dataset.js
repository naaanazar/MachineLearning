$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).on('input', '#rows-number', function(e) {
    var value = $(e.target).val();
    var newVal = value.replace(/^0|\D+/g, '');

    $("#rows-number").val(newVal);

    if ($("#rows-number").val() !== "") {
        $('#generate-btn').removeClass('disabled');
    } else {
        $('#generate-btn').addClass('disabled');
    }
});

$(document).ready(function() {

    $('#generate-btn').on('click', function(e) {

        e.preventDefault();
        $('.empty-msg').empty();
        $('#rows-number').removeClass('warning');

        var route = $(this).attr('href');
        var rowsNumber = $('#rows-number').val();

        if (rowsNumber === "") {
            $(".empty-msg").html("This Field is required!");
            $('#rows-number').addClass('warning');
            return;
        }

        $('i.fa-spinner').css('display', 'inline-block');

        $.ajax({
            method: 'POST',
            url: route,
            dataType: 'JSON',
            data: {
                rows: rowsNumber,
                "_token": $('meta[name=csrf-token]').attr('content')
            },
            success: function(data) {
                $('i.fa-spinner').hide();
                if (!$.isEmptyObject(data)) {
                    var stats = data.stats;
                    var content = '<ul>';
                    content += '<li>Records number: ' + stats.recordsNumber + '</li>';
                    content += '<li>Purchase number: ' + stats.purchaseNumber + '</li>';
                    content += '<li>Purchase percentage: ' + stats.purchasePercentage + '</li>';
                    var link = "<a href='datasets/" + stats.path + "'>dataset</a>";
                    content += '<li>Link to dataset: ' + link + '</li>';
                    content += '</ul>';
                    $('.empty-msg').html(content).css('color', "#000");
                }
            },
            error: function(xhr, status, error) {
                $('i.fa-spinner').hide();
                if (xhr.status === 500) {
                    $.jGrowl("Token Mismatch!", {
                        sticky: true,
                        theme: 'jgrowl-danger'
                    });
                    return;
                }
                var errorMessages = xhr.responseJSON.rows;
                $(".empty-msg").append(errorMessages);
                $('#rows-number').addClass('warning');
            }
        });
    });
});