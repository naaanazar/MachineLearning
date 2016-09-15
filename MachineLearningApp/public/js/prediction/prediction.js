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
        $('body,html').animate({scrollTop: top}, "slow");
        $.ajaxSetup({
            headers: {
                'X-XSRF-Token': $('meta[name="_token"]').attr('content')
            }
        });

        var formData   = $(this).serialize();
        var formAction = $(this).attr('action');
        var formMethod = $(this).attr('method');

        addPredictionProgress();

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

    function realTimePredictionValidation(selector, lengthVal, regexp, message) {

        $('.form-prediction').on('input', selector, function(e){
            var value = $(e.target).val();
            var error = selector + " + .pred-error";
            var regExp = new RegExp(regexp, "g");
            var newValue = value.replace(regExp, "");
            $(selector).val(newValue.substr(0, lengthVal));
            $(selector).focusout(function(event) {
                $(error).fadeOut('slow');
            });


            if (newValue.length > lengthVal) {
                $(error).fadeIn('slow');
                $(error).html(errorPred("Length no more " + lengthVal));
                $(error).fadeOut('slow');
            } else if (!newValue) {
                $(error).fadeIn('slow');
                $(error).html(errorPred(message));
            } else if (newValue) {
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