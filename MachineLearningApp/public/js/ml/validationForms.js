$(document).ready(function () {

    startPageValidation();

    function checkFormData(selector) {
        $('.modal').on('hidden.bs.modal', function () {
            validationError($(selector));
            $(selector).val('');
        });
    }

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

                checkFormData(this);

                if (val.length > 2 && val != '' && nameValidation.test(val)) {
                    validationSuccess($(this));
                } else {
                    validationError($(this));
                }
                break;

            case 'DataRearrangementBegin':
                tab = 'ds';

                checkFormData(this);

                if (val.length > 0 && val != '' && countValidation.test(val)) {
                    validationSuccess($(this));

                } else {
                    validationError($(this));
                }
                break;

            case 'DataRearrangementEnd':
                tab = 'ds';

                checkFormData(this);

                if (val.length > 0 && val != '' && countValidation.test(val)) {
                    validationSuccess($(this));
                } else {
                    validationError($(this));
                }
                break;

            case 'MLModelName':
                tab = 'ml';

                checkFormData(this);

                if (val.length > 2 && val != '' && nameValidation.test(val)) {
                    validationSuccess($(this));
                } else {
                    validationError($(this));
                }
                break;

            case 'EvaluationName':
                tab = 'ev';

                checkFormData(this);

                if (val.length > 2 && val != '' && nameValidation.test(val)) {
                    validationSuccess($(this));
                } else {
                    validationError($(this));
                }
                break;
        }

        if ($(this).closest('form').find('div.has-error').hasClass('has-error') == true) {
            $(this).closest('form').find('input#success-button-modal-' + tab).attr('disabled', true);
        } else {
            $(this).closest('form').find('input#success-button-modal-' + tab).removeAttr('disabled');
        }

    });
});

function startPageValidation() {
    $('input#MLModelName').addClass('error');
    $('input#MLModelName').closest('div').addClass('has-error');


    $('input#EvaluationName').addClass('error');
    $('input#EvaluationName').closest('div').addClass('has-error');

    $('input#DataSourceName').addClass('error');
    $('input#DataRearrangementBegin').addClass('error');
    $('input#DataRearrangementEnd').addClass('error');
    $('input#DataSourceName').closest('div').addClass('has-error');
    $('input#DataRearrangementBegin').closest('div').addClass('has-error');
    $('input#DataRearrangementEnd').closest('div').addClass('has-error');
}