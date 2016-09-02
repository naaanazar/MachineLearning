$(document).ready(function () {
    // tooltip from upload button
    $("[data-toggle='tooltip']").tooltip();
    // upload button without submit
    $('#input-file').change(function(){
        $('.form-upload').submit();
    });

    $(".create-datasource").hide();
    $(".btn-create-datasource").click(function(){
        $(".create-datasource").show();
    });
    $(".create-mlmodel").hide();
    $(".btn-create-mlmodel").click(function(){
        $(".create-mlmodel").show();
    });
    $(".create-bath-description").hide();
    $(".btn-create-bath-description").click(function(){
        $(".create-bath-description").show();
    });    
    $(".create-evaluations").hide();
    $(".btn-create-evaluations").click(function(){
        $(".create-evaluations").show();
    });
    // upload show/hide message
    $(".upload-message").show().delay(1500).fadeOut(1000);




});

