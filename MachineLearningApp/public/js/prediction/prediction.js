    var RT_PREDICTED = RT_PREDICTED || {};

    RT_PREDICTED.MLModel = {
        result: "",

        getId: function() {
            $.get("/ml/select-ml-model", function(response) {
                for (var key in response.data) {
                    this.result +=
                        '<option value="' + response.data[key].MLModelId + '">' +  response.data[key].Name + '</option>';
                }

               $('#ml_model_id').html(this.result);
            });
        }
    }

    RT_PREDICTED.Form = {
        output: "",
        content: "",
        purchase: "",
        formData: "",
        error422 : "",
        formAction: "",
        formMethod: "",

        addProgress: function () {
            $('.prediction-data').empty();
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

                RT_PREDICTED.Form.addProgress();
                RT_PREDICTED.Form.ajax();
            });
        },

        ajax: function() {
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
            this.error422 = '<h4 class="error text-center">No valid data!</h4>';

            $.ajax({
                type: this.formMethod,
                url: this.formAction,
                data: this.formData,
                cache: false,
                success: function(response) {

                    if (response == 'Updating') {
                        setTimeout(RT_PREDICTED.Form.ajax(), 3000);
                    } else {
                        RT_PREDICTED.Form.removeProgress();

                        this.output = $.parseJSON(response);
                        this.purchase = this.output.predictedLabel == 0 ? "No" : "Yes";

                        this.content = "<p><strong>Purchase: </strong><span>";
                        this.content += this.purchase + ";</span></p>";
                        this.content += "<p><strong>Predicted Scores: </strong><span>";
                        this.content += this.output.predictedScores[0].toFixed(4) + ";</span></p>";
                        this.content += "<p><strong>Algorithm: </strong><span>";
                        this.content += this.output.details.Algorithm + ";</span></p>";
                        this.content += "<p><strong>Predictive Model Type: </strong><span>"
                        this.content += this.output.details.PredictiveModelType + ";</span></p>";

                        $('.prediction-data').append(this.content).show('normal');
                    }
                },
                error: function(jqXhr) {
                    if(jqXhr.status === 422) {
                        RT_PREDICTED.Form.removeProgress();

                        $('.prediction-data').empty();
                        $('.prediction-data').append(this.error422);
                    } else {
                        setTimeout(RT_PREDICTED.Form.ajax(), 3000);
                    }
                }
            });
        },
    }

    RT_PREDICTED.Validation = {
        regExp: "",
        errorMsg: "",
        newValue: "",
        valueField: "",
        errorTarget: "",
        lengthField: "",

        error: function (err) {
            this.errorMsg = '<div class="alert alert-danger pred-alert">'
            this.errorMsg += '<ul><li><strong>' + err + '</strong></li></ul></div>';

            return this.errorMsg;
        },

        disabledBtn: function () {
            $('.input-pred').on('keyup mouseenter', function() {
                var count = 0;
                $('.input-pred').each(function() {
                    this.lengthField = $(this).val() === null ? 0 : $(this).val().length;
                    if (this.lengthField === 0) {
                        count++;
                    }
                });

                if (count === 9) {
                    $('.btn-pred').attr('disabled', 'disabled');
                } else if (count < 9) {
                     $('.btn-pred').removeAttr('disabled');
                }
            });
        },

        validation: function (selector, lengthVal, regexp, message) {
            $('.form-prediction').on('input', selector, function(e){
                this.valueField = $(e.target).val();
                this.errorTarget = selector + " + .pred-error";
                this.regExp = new RegExp(regexp, "g");
                this.newValue = this.valueField.replace(this.regExp, "");

                $(selector).val(this.newValue.substr(0, lengthVal));

                $(selector).focusout(function(event) {
                    $(this.errorTarget).fadeOut('slow');
                    $(selector).removeClass('pred-input-error');
                });

                if (this.newValue.length > lengthVal) {
                    $(this.errorTarget).fadeIn('slow');
                    $(this.errorTarget).html(RT_PREDICTED.Validation.error("Length no more " + lengthVal));
                    $(selector + ":focus").addClass('pred-input-error');
                } else if (!this.newValue) {
                    $(selector + ":focus").addClass('pred-input-error');
                    $(this.errorTarget).fadeIn('slow');
                    $(this.errorTarget).html(RT_PREDICTED.Validation.error(message));
                } else {
                    $(this.errorTarget).fadeOut('slow');
                    $(selector).removeClass('pred-input-error');
                }
            });
        },

        init: function() {
            this.disabledBtn();
            this.validation("#email", 1, "[^0-1]", "Enter the 0 or 1");
            this.validation("#has-privat-project", 1, "[^0-1]", "Enter the 0 or 1");
            this.validation("#same-log-project", 1, "[^0-1]", "Enter the 0 or 1");
            this.validation("#same-email", 10, "^00|[^0-9]", "Enter the valid number");
            this.validation("#projects-count", 10, "^00|[^0-9]", "Enter the valid number");
            this.validation("#string-count", 10, "^00|[^0-9]", "Enter the valid number");
            this.validation("#string-count", 10, "^00|[^0-9]", "Enter the valid number");
            this.validation("#members-count", 10, "^00|[^0-9]", "Enter the valid number");
            this.validation("#last-login", 10, "^00|[^0-9]", "Enter the valid number");
            this.validation("#country", 60, "^ |[^a-zA-Z ]", "Enter the letter");
        }
    }

$(document).ready(function() {
    RT_PREDICTED.MLModel.getId();
    RT_PREDICTED.Validation.init();
    RT_PREDICTED.Form.send();
});