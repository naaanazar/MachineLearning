$(document).ready(function () {
    function validationBucket(selector, lengthVal, regexp) {
        $('.create-datasource').on('input', selector, function (e){
            this.valueField = $(e.target).val();
            this.regExp = new RegExp(regexp, "g");

            this.newValue = this.valueField.replace(this.regExp, "");
            $(selector).val(this.newValue.substr(0, lengthVal));
        });
        $(selector).on("keyup click",function(e) {
            var empty = false;

            $(selector).each(function () {
                if($(this).val()) {
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

    validationBucket("#nameBucket", 255, "^ |[^0-9a-zA-Z-._]");
});