$(document).ready(function () {
    // tooltip from upload button
    $("[data-toggle='tooltip']").tooltip();

    // upload button without submit
    $('#input-file').change(function(){
        $('.form-upload').submit();
    });

<<<<<<< HEAD

    $(".create-datasource").hide();

=======
    $(".create-datasource").hide();
>>>>>>> master
    $(".btn-create-datasource").click(function(){
        $(".create-datasource").show();
    });

    // upload show/hide message
    $(".upload-message").show().delay(1500).fadeOut(1000);

});