var RT_PREDICTION = RT_PREDICTION || {};

RT_PREDICTION.MLModel = {
    result: "",

    getId: function () {
        $.get("/ml/select-ml-model", function (response) {
            for (var key in response.data) {
                this.result +=
                    '<option value="' + response.data[key].MLModelId + '">' +  response.data[key].Name + '</option>';
            }

           $('#ml_model_id').html(this.result);
        });
    }
}

RT_PREDICTION.Form = {
    result: "",
    content: "",
    purchase: "",
    formData: "",
    formAction: "",
    formMethod: "",
    predictedScores: "",

    addProgress: function () {
        $('.notification-pred').fadeOut('slow');
        $('.data-prediction').empty();
        $('input').attr('disabled', 'disabled');
        $('.spinner-prediction').fadeIn('slow');
    },

    removeProgress: function () {
        $('.spinner-prediction').hide('slow');
        $('input').removeAttr('disabled');
    },

    send: function () {
        $('.form-prediction').on('submit', function(e) {
            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-XSRF-Token': $('meta[name="_token"]').attr('content')
                }
            });

            RT_PREDICTION.Form.addProgress();
            RT_PREDICTION.Form.ajax();
        });
    },

    ajax: function () {
        this.formData = {
            country: $('input[name=country]').val(),
            ml_model_id: $('select[name=ml_model_id').val(),
            strings_count: $('input[name=strings_count]').val(),
            members_count: $('input[name=members_count]').val(),
            projects_count: $('input[name=projects_count]').val(),
            email_custom_domain: $('input[name=email_custom_domain]').val(),
            has_private_project: $('input[name=has_private_project]').val(),
            days_after_last_login: $('input[name=days_after_last_login]').val(),
            same_email_domain_count: $('input[name=same_email_domain_count]').val(),
            same_login_and_project_name: $('input[name=same_login_and_project_name]').val(),
        }

        this.formAction = $('.form-prediction').attr('action');
        this.formMethod = $('.form-prediction').attr('method');

        $.ajax({
            type: this.formMethod,
            url: this.formAction,
            data: this.formData,
            cache: false,
            success: function (response) {
                var endPointErr =  "Endpoint is not created! Try again or contact support!!";
                var predictionErr = "Fail prediction! Try again or contact support!!";

                if (response.status ===  false) {
                    if(response.result === endPointErr) {
                        RT_PREDICTION.Form.error(endPointErr);
                    } else if (response.result === predictionErr) {
                        RT_PREDICTION.Form.error(predictionErr);
                    } else {
                        setTimeout(RT_PREDICTION.Form.ajax(), 3000);
                    }
                } else {
                    RT_PREDICTION.Form.removeProgress();

                    this.result = response.result;
                    this.purchase = response.result.predictedLabel == 0 ? "No" : "Yes";
                    this.predictedScores = this.purchase === "No" ?
                                           this.result.predictedScores[0] :
                                           this.result.predictedScores[1];

                    this.content = "<p><strong>Purchase: </strong><span>";
                    this.content += this.purchase + ";</span></p>";
                    this.content += "<p><strong>Predicted Scores: </strong><span>";
                    this.content += this.predictedScores.toFixed(4) + ";</span></p>";
                    this.content += "<p><strong>Algorithm: </strong><span>";
                    this.content += this.result.details.Algorithm + ";</span></p>";
                    this.content += "<p><strong>Predictive Model Type: </strong><span>"
                    this.content += this.result.details.PredictiveModelType + ";</span></p>";

                    $('.data-prediction').append(this.content).show('normal');
                }
            },
            error: function (jqXhr) {
                if(jqXhr.status === 422) {
                    RT_PREDICTION.Form.error("Сheck the validity of the data");
                } else if (jqXhr.status === 500 || jqXhr.status === 400 || jqXhr.status === 405) {
                    RT_PREDICTION.Form.error("Something is wrong! Try later or contact support!");
                } else {
                    setTimeout(RT_PREDICTION.Form.ajax(), 3000);
                }
            }
        });
    },

    error: function (message) {
        RT_PREDICTION.Form.removeProgress();

        $('.data-prediction').empty();
        $('body,html').animate({scrollTop: 0}, 500);
        $('.notif-data').empty();
        $('.notif-data').append(message);
        $('.notification-pred').show().fadeIn();
        $('.notif-close').on('click', function () { $('.notification-pred').fadeOut(); });
    }
}

RT_PREDICTION.Validation = {
    regExp: "",
    errorMsg: "",
    newValue: "",
    valueField: "",
    errorTarget: "",
    lengthField: 0,

    checkRequired: function () {
        $('.input-pred').on("keyup click",function(e) {
            var empty = false;

            $('.input-pred').each(function () {
                if($(this).val()) {
                    empty = true;
                }
            });

            if (!empty) {
                $('.btn-pred').attr('disabled', 'disabled');
            } else if (empty) {
                 $('.btn-pred').removeAttr('disabled');
            }
        });
    },

    validation: function (selector, lengthVal, regexp, message) {
        $('.form-prediction').on('input', selector, function (e){
            this.valueField = $(e.target).val();
            this.errorTarget = selector + " + .pred-error";
            this.regExp = new RegExp(regexp, "g");
            this.newValue = this.valueField.replace(this.regExp, "");

            $(selector).val(this.newValue.substr(0, lengthVal));

            $(selector).focusout(function (e) {
                $(this.errorTarget).fadeOut('slow');
                $(selector).removeClass('pred-input-error');
            });

            $(selector).on('keyup', function(e){
                if (e.keyCode === 8) {
                    $(this.errorTarget).fadeOut('slow');
                    $(selector).removeClass('pred-input-error');
                } else if (e.key.match(regexp)){
                    $(this.errorTarget).fadeIn('slow');
                    $(this.errorTarget).html(RT_PREDICTION.Validation.error(message));
                    $(selector + ":focus").addClass('pred-input-error');
                } else if (this.newValue.length > lengthVal) {
                    $(this.errorTarget).fadeIn('slow');
                    $(this.errorTarget).html(RT_PREDICTION.Validation.error("Length no more " + lengthVal));
                    $(selector + ":focus").addClass('pred-input-error');
                } else {
                    $(this.errorTarget).fadeOut('slow');
                    $(selector).removeClass('pred-input-error');
                }
            });
        });
    },

    error: function (message) {
        this.errorMsg = '<div class="alert alert-danger pred-alert">'
        this.errorMsg += '<ul><li><strong>' + message + '</strong></li></ul></div>';

        return this.errorMsg;
    },

    init: function() {
        this.checkRequired();
        this.validation("#email", 1, "[^0-1]", "Enter the 0 or 1");
        this.validation("#has-privat-project", 1, "[^0-1]", "Enter the 0 or 1");
        this.validation("#same-log-project", 1, "[^0-1]", "Enter the 0 or 1");
        this.validation("#same-email", 10, "^0[0-9]|[^0-9]", "Enter the valid number");
        this.validation("#projects-count", 10, "^0[0-9]|[^0-9]", "Enter the valid number");
        this.validation("#string-count", 10, "^0[0-9]|[^0-9]", "Enter the valid number");
        this.validation("#string-count", 10, "^0[0-9]|[^0-9]", "Enter the valid number");
        this.validation("#members-count", 10, "^0[0-9]|[^0-9]", "Enter the valid number");
        this.validation("#last-login", 10, "^0[0-9]|[^0-9]", "Enter the valid number");
        this.validation("#country", 60, "^ |  |[^a-zA-Z ]", "Enter the letter");
    }
}

$(document).ready(function() {
    RT_PREDICTION.MLModel.getId();
    RT_PREDICTION.Validation.init();
    RT_PREDICTION.Form.send();
});