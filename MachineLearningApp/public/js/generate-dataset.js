$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function() {
    $('#generate-btn').on('click', function(e) {
        e.preventDefault();
        $('.messages').empty();
        $('i.fa-spinner').show();
        var route = $(this).attr('href');
        var rowsNumber = $('#rows-number').val();
        
        $.ajax({
            method: 'POST',
            url: route,
            dataType: 'JSON',
            data: {
                rows: rowsNumber,
                "_token": $('meta[name=csrf-token]').attr('content')
            },
            success: function (data) {
                $('i.fa-spinner').hide();
                if(!$.isEmptyObject(data)) {
                    var stats = data.stats;
                    var content = '<ul>';
                    content += '<li>Records number: ' +stats.recordsNumber+ '</li>';
                    content += '<li>Purchase number: ' +stats.purchaseNumber+ '</li>';
                    content += '<li>Purchase percentage: ' +stats.purchasePercentage+ '</li>';
                    var link = "<a href='" +stats.path+ "'>dataset</a>";
                    content += '<li>Link to dataset: ' +link+ '</li>';
                    content += '</ul>';
                    $('.messages').html(content);
                }
            },
            error: function (error) {
                $('i.fa-spinner').hide();
                console.log(error);
                if(error.status === 500) {
                    $('.messages').html("Token Mismatch!");
                    return;
                }
                var errorMessages = error.responseJSON.rows;
                console.log(errorMessages);
                $('.messages').html(errorMessages);
            }
        });
    });
});