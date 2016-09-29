$(document).ready(function() {
    $("#ml-button-create").on('click', '.btn', function (e) {
        function checkFormData(selector) {
            $('.modal').on('input', selector, function (e){
                var valueField = $(e.target).val();
                var regExp = new RegExp("^ |  |^[^a-zA-Z ]|[^a-zA-Z0-9-_\.]", "g");

                newValue = valueField.replace(regExp, "");
                $(selector).val(newValue.substr(0, 20));
            });
        }

        function checkRequired(selector, tab) {
            $(selector).on("keyup click",function(e) {
                var empty = false;

                if($(this).val().length >= 5) {
                    empty = true;
                }

                if (!empty) {
                    $('input#success-button-modal-' + tab).attr('disabled', true);
                } else if (empty) {
                     $('input#success-button-modal-' + tab).removeAttr('disabled');
                }
            });

            $('.modal').on('hidden.bs.modal', function () {
                $(selector).val('');
                $('input#success-button-modal-' + tab).attr('disabled', true);
            });
        }

        function checkDatasourceField() {
            $('.modal').on('change keyup', "#SelectBuckets, #SelectDataLocationS3, #DataSourceName", function(e) {
                var bucket = $("#SelectBuckets").val();
                var s3Value = $("#SelectDataLocationS3").val();
                var ds = $('#DataSourceName').val();

                if (bucket != '' && (s3Value != null && s3Value != '') && ds.length >= 5) {
                    $('input#success-button-modal-ds').removeAttr('disabled');
                } else {
                    $('input#success-button-modal-ds').attr('disabled', true);
                }

            });
        }

        checkFormData("#DataSourceName");
        checkFormData("#MLModelName");
        checkFormData("#EvaluationName");
        checkRequired("#MLModelName", "ml");
        checkRequired("#EvaluationName", "ev");
        checkDatasourceField();
    });
});