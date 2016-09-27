$(document).ready(function () {

    startPageValidation();

    function validationSuccess($element) {
        $element.removeClass('error').addClass('not_error');
        $element.closest('div').removeClass('has-error');
        $element.closest('div').addClass('has-success has-feedback');
        $element.closest('div').find('span').removeClass('hide');
    }

    function validationError($element) {
        $element.removeClass('not_error').addClass('error');
        $element.closest('div').addClass('has-error has-feedback');
        $element.closest('div').find('span').addClass('hide');
    }

    $(document).on('blur', '.form-control', function (e) {

        var id = e.target.id;
        var val = e.target.value;
        var tab = '';
        var nameValidation = /^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$/;
        var countValidation = /^[0-9][0-9]?$|^100$/;

        switch (id) {
            case 'DataSourceName':
                tab = 'ds';

                if (val.length > 2 && val != '' && nameValidation.test(val)) {
                    validationSuccess($(this));
                } else {
                    validationError($(this));
                }
                break;

            case 'DataRearrangementBegin':
                tab = 'ds';

                if (val.length > 0 && val != '' && countValidation.test(val)) {
                    validationSuccess($(this));

                } else {
                    validationError($(this));
                }
                break;

            case 'DataRearrangementEnd':
                tab = 'ds';

                if (val.length > 0 && val != '' && countValidation.test(val)) {
                    validationSuccess($(this));
                } else {
                    validationError($(this));
                }
                break;

            case 'MLModelName':
                tab = 'ml';

                if (val.length > 2 && val != '' && nameValidation.test(val)) {
                    validationSuccess($(this));
                } else {
                    validationError($(this));
                }
                break;

            case 'EvaluationName':
                tab = 'ev';

                if (val.length > 2 && val != '' && nameValidation.test(val)) {
                    validationSuccess($(this));
                } else {
                    validationError($(this));
                }
                break;
        }

        if ($(this).closest('form').find('div.has-error').hasClass('has-error') == true) {
            $(this).closest('form').find('input#success-button-modal-' + tab).attr('disabled', 'disabled');
        } else {
            $(this).closest('form').find('input#success-button-modal-' + tab).removeAttr('disabled');
        }

    });
});

function startPageValidation() {
    $('input#MLModelName').addClass('error');
    $('input#success-button-modal-ml').addClass('disabled');
    $('input#MLModelName').closest('div').addClass('has-error');


    $('input#EvaluationName').addClass('error');
    $('input#success-button-modal-ev').addClass('disabled');
    $('input#EvaluationName').closest('div').addClass('has-error');

    $('input#DataSourceName').addClass('error');
    $('input#DataRearrangementBegin').addClass('error');
    $('input#DataRearrangementEnd').addClass('error');
    $('input#success-button-modal-ds').addClass('disabled');
    $('input#DataSourceName').closest('div').addClass('has-error');
    $('input#DataRearrangementBegin').closest('div').addClass('has-error');
    $('input#DataRearrangementEnd').closest('div').addClass('has-error');
}