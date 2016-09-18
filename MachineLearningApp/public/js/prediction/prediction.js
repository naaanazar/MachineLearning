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
        $('html, body').animate({scrollTop:0}, '500', 'swing');
        $.ajaxSetup({
            headers: {
                'X-XSRF-Token': $('meta[name="_token"]').attr('content')
            }
        });

        var content;
        var formData   = $(this).serialize();
        var formAction = $(this).attr('action');
        var formMethod = $(this).attr('method');
        var error422 = '<h4 class="error text-center">All field required!</h4>';

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
                        var output = $.parseJSON(data);
                        content = "<h3><strong>Purchase:</strong> " + output.predictedLabel + "</h3>";
                        content += "<h3><strong>Purchase:</strong> " + output.predictedScores[0] + "</h3>";
                        content += "<h3><strong>Purchase:</strong> " + output.predictedScores[1] + "</h3>";
                        $('.prediction-data').append(content);
                        console.log(content);
                    }
                },
                error: function(jqXhr) {
                    if( jqXhr.status === 422 ) {
                        removePredictionProgress();
                        $('.prediction-data').empty();
                        $('.prediction-data').append(error422);
                    } else {
                        setTimeout(formPredict(), 3000);
                    }
                }
            });
        }
        formPredict();
    });

    // prediction: form processing style
    function addPredictionProgress() {
        $('.prediction-data').empty();
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

    function predDisabledBtn() {
        $('.input-pred').on('keyup mouseenter', function() {
           var empty = false;
            $('.input-pred').each(function() {
                var value = $(this).val() === null ? 0 : $(this).val().length;
                if (value === 0) {
                    empty = true;
                }
            });
            if (empty) {
                $('.btn-pred').attr('disabled', 'disabled');
            } else {
                 $('.btn-pred').removeAttr('disabled');
            }
        });
    }

    function predictionValidation(selector, lengthVal, regexp, message) {
        $('.form-prediction').on('input', selector, function(e){
            var value = $(e.target).val();
            var error = selector + " + .pred-error";
            var regExp = new RegExp(regexp, "g");
            var newValue = value.replace(regExp, "");
            $(selector).val(newValue.substr(0, lengthVal));
            $(selector).focusout(function(event) {
                $(error).fadeOut('slow');
                $(selector).removeClass('pred-input-error');

            });

            if (newValue.length > lengthVal) {
                $(error).fadeIn('slow');
                $(error).html(errorPred("Length no more " + lengthVal));
                $(selector + ":focus").addClass('pred-input-error');
            } else if (!newValue) {
                $(selector + ":focus").addClass('pred-input-error');
                $(error).fadeIn('slow');
                $(error).html(errorPred(message));
            } else {
                $(error).fadeOut('slow');
                $(selector).removeClass('pred-input-error');
            }
        });
    }

    predDisabledBtn();
    predictionValidation("#email", 1, "[^0-1]", "Enter the 0 or 1");
    predictionValidation("#has-privat-project", 1, "[^0-1]", "Enter the 0 or 1");
    predictionValidation("#same-log-project", 1, "[^0-1]", "Enter the 0 or 1");
    predictionValidation("#same-email", 10, "[^0-9]", "Enter the number");
    predictionValidation("#projects-count", 10, "[^0-9]", "Enter the number");
    predictionValidation("#string-count", 10, "[^0-9]", "Enter the number");
    predictionValidation("#string-count", 10, "[^0-9]", "Enter the number");
    predictionValidation("#members-count", 10, "[^0-9]", "Enter the number");
    predictionValidation("#last-login", 10, "[^0-9]", "Enter the number");
    predictionValidation("#country", 60, "^ |[^a-zA-Z ]", "Enter the letter");

});