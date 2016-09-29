function checkMLData(selector) {
    $('.modal').on('input', selector, function(e){
        var valueField = $(e.target).val();
        var regExp = new RegExp("^ |  |^[^a-zA-Z ]|[^a-zA-Z0-9-_\.]", "g");
        var newValue = valueField.replace(regExp, "");

        $(selector).val(newValue.substr(0, 20));
    });
}

function checkMLRequired(selector, tab) {
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

function checkDatasourceField(selector, bucket, s3, tab) {
    $('.modal').on('change keyup', bucket + ", " + s3 + ", "+ selector, function(e) {
        var bucket = $(bucket).val();
        var s3Value = $(s3).val();
        var ds = $(selector).val();

        if (ds.length >= 5 && bucket != '' && (s3Value != null && s3Value != '')) {
            $('input#success-button-modal-' + tab).removeAttr('disabled');
        } else {
            $('input#success-button-modal-' + tab).attr('disabled', true);
        }
    });

    $('.modal').on('hidden.bs.modal', function () {
        $(selector).val('');
        $('input#success-button-modal-' + tab).attr('disabled', true);
    });
}

$(document).ready(function() {
    $("#ml-button-create").on('click', '.btn', function(e) {
        checkMLData("#DataSourceName");
        checkMLData("#MLModelName");
        checkMLData("#EvaluationName");
        checkMLRequired("#MLModelName", "ml");
        checkMLRequired("#EvaluationName", "ev");
        checkDatasourceField("#DataSourceName", "#SelectBuckets", "#SelectDataLocationS3", "ds");
    });

    $('.ml-button-block').on('click', '.btn-create-mlmodel-main', function(e) {
        checkMLData("#MLMainModelName");
        checkDatasourceField("#MLMainModelName", "#SelectBucketsMain", "#SelectDataLocationS3Main", "ml");
    });
});