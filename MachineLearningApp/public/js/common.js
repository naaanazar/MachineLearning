$(document).ready(function () {
    // tooltip from upload button
    $("[data-toggle='tooltip']").tooltip();
    // upload button without submit
    $('#input-file').change(function() {
        $('.form-upload').submit();
    } ) ;

    $('.btn-create-mlmodel').click(function(){
        $('.create-mlmodel').fadeToggle();
    });   
    $(".btn-create-bath-description").click(function() {
        $(".create-bath-description").fadeToggle();
    } ) ;   
    $(".btn-create-evaluations").click(function() {
        $(".create-evaluations").fadeToggle();
    }); 
    $(".btn-create-datasource").click(function() {
        $(".create-datasource").fadeToggle();         
    });
    // uplo ad show/hide message
    $(".upload-message").show().delay(1500).fadeOut(1000);
} ) ;