$(document).ready(function () {
    function validationBucket(selector, lengthVal, regexp) {
        $('.create-datasource').on('input', selector, function (e){
            var valueField = $(e.target).val();
            var regExp = new RegExp(regexp, "g");

            var newValue = valueField.replace(regExp, "");
            $(selector).val(newValue.substr(0, lengthVal));
        });

        $(selector).on("keyup click",function(e) {
            var empty = false;

            $(selector).each(function () {
                if($(this).val().length >= 3) {
                    empty = true;
                }
            });

            if (!empty) {
                $('.btn-bucket').attr('disabled', 'disabled');
            } else if (empty) {
                 $('.btn-bucket').removeAttr('disabled');
            }
        });
    }

    $(document).on('click', '.btn-delete-bucket', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        var fileName = $(this).data('name');

        $.post(url, function(response) {
            deleteBucket(fileName);
            if (response.status = true) {
                $(e.target).closest("tr").fadeOut("slow");
            }
        });
    });

    validationBucket("#nameBucket", 63, "^ |[^0-9a-zA-Z-._]");

    $(document).on('click', '.btn-delete', function (e) {
        e.preventDefault();
        var name = $(this).attr('id');
        var fileName = $(this).data('name');

        $.ajax({
            url: '/s3/delete',
            method: 'post',
            data: {
            name: $(this).attr('id')
            },
            success: function (data) {

                deleteFile(fileName);

                if (data.success) {
                    $(e.target).closest('tr').remove("tr");
                }

                $.jGrowl('Successfully removed: ' + name, {
                    theme: 'jgrowl-success'
                });

            },
            error: function () {
                $.jGrowl('An error occurred during delete process', {
                    theme: 'jgrowl-danger'
                });
            }
        });
    });
});