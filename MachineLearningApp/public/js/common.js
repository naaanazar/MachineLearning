$(document).ready(function () {
    $('.ml-tabs').on('click', 'a', function (e) {
        e.preventDefault();
             window.location.hash = $(this).attr('href');
        $(this).tab('show');
    });
        if (window.location.hash) {
            $('.ml-tabs').find('a[href="' + window.location.hash + '"]').tab('show');
    }

    $("[data-toggle='tooltip']").tooltip();   

    $(".upload-message").show().delay(1500).fadeOut(1000);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function success(selector, str) {
        $(selector).append('<div class="alert alert-success upload-message-s3">' +
            '<ul><li><strong>Success! </strong>' +
            str + '</li></ul></div>').show('slow').hide(4000);
    }

    function errorS3(selector) {
        $(selector).append('<div class="alert alert-danger upload-message-s3">' +
            '<ul><li><strong>Error! File is not loaded to S3!</strong>' +
            '</li></ul></div>').show('slow').hide(4000);
    }    

    $(document).on('click', '.download', function (e) {
        var url = encodeURI('/s3/download-from-s3?name=' + $(this).data('download-path'));
            e.preventDefault();

        $.get('/s3/file-exists', {
            name: encodeURI($(this).data('download-path'))
        }, function (response) {
            if (response.data == true) {
                window.location = url;
            } else {
                $.jGrowl('File not exists', {
                    theme: 'jgrowl-danger'
                });
            }
        });
    });

    $('.form-upload').on("submit", function (e) {
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
            },
        });
    });

});

function timeConverter(time) {
    UnixTimestamp = Date.parse(time);
        var a = new Date(UnixTimestamp);
        var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        var year = a.getFullYear();
        var month = months[a.getMonth()];
        var date = a.getDate();
        var hour = a.getHours();
        var min = a.getMinutes();
        var sec = a.getSeconds();
        var time = date + ' ' + month + ' ' + year + ' ' + hour + ':' + min + ':' + sec;

    return time;
};
