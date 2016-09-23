$(document).ready(function () {
    function validationBucket(selector, lengthVal, regexp) {
        $('.create-datasource').on('input', selector, function (e){
            this.valueField = $(e.target).val();
            this.regExp = new RegExp(regexp, "g");

            this.newValue = this.valueField.replace(this.regExp, "");
            $(selector).val(this.newValue.substr(0, lengthVal));
        });
    }

    validationBucket("#nameBucket", 255, "^ |[^0-9a-zA-Z-._]");
});