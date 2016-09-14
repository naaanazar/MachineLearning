$(document).ready(function() {
    // prediction: get id model
    $.get("/ml/select-ml-model", function(response) {
        var result;
        for (var key in response.data) {
            result += '<option value="' 
                   + response.data[key].MLModelId 
                   + '">' + response.data[key].Name 
                   + '</option>';
        }
        $('#ml_model_id').html(result);
    });

    // prediction: send form
    $('.form-prediction').on('submit', function(e) {
        e.preventDefault();
        addPredictionProgress();
        $.ajaxSetup({
            headers: {
                'X-XSRF-Token': $('meta[name="_token"]').attr('content')
            }
        });

        var formData   = $(this).serialize();
        var formAction = $(this).attr('action');
        var formMethod = $(this).attr('method');

        function formPredict() {
            $.ajax({
                type: formMethod,
                url: formAction,
                data: formData,
                cache: false,
                success: function(data) {
                    if (data == 'Updating') {
                        setTimeout(formPredict(), 3000);
                    } else {
                        removePredictionProgress();
                        $('.prediction-data').append(data);
                    }
                },
                error: function() {
                    setTimeout(formPredict(), 3000);
                }
            });
        }
        formPredict();
    });

    // prediction: form processing style
    function addPredictionProgress() {
        $('input').attr('disabled', 'disabled');
        $('.spinner-prediction').fadeIn('slow');
        $('.pred-data').empty();
    }

    function removePredictionProgress() {
        $('.spinner-prediction').hide('slow');
        $('input').removeAttr('disabled');
    }

    // prediction: validation form
    function errorPred(data) {
        var content = '<div class="alert alert-danger pred-alert">'
                    + '<ul><li><strong>' + data + '</strong>'
                    + '</li></ul></div>';
        return content;
    }

    function realTimePredictionValidation(selector, length, regexp, message) {
        $('.form-prediction').on('input', selector, function(e){
            var value = $(e.target).val();
            var error = selector + " + .pred-error";
            var regExp = new RegExp(regexp, "g");
            value = value.replace(regExp, "");
            $(selector).val(value.substr(0, length));
            $(selector).focusout(function(event) {
                $(error).fadeOut('slow');
            });
            if (!value.replace(regExp, "")) {
                $(error).fadeIn('slow');
                $(error).html(errorPred(message));
            } else {
                $(error).fadeOut('slow');
            }
        });
    }

    realTimePredictionValidation("#email", 1, "[^0-1]", "Enter the 0 or 1");
    realTimePredictionValidation("#has-privat-project", 1, "[^0-1]", "Enter the 0 or 1");
    realTimePredictionValidation("#same-log-project", 1, "[^0-1]", "Enter the 0 or 1");
    realTimePredictionValidation("#same-email", 10, "[^0-9]", "Enter the number");
    realTimePredictionValidation("#projects-count", 10, "[^0-9]", "Enter the number");
    realTimePredictionValidation("#string-count", 10, "[^0-9]", "Enter the number");
    realTimePredictionValidation("#string-count", 10, "[^0-9]", "Enter the number");
    realTimePredictionValidation("#members-count", 10, "[^0-9]", "Enter the number");
    realTimePredictionValidation("#last-login", 10, "[^0-9]", "Enter the number");
    realTimePredictionValidation("#country", 60, "^ |[^a-zA-Z ]", "Enter the letter");

});